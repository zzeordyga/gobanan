<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Service;
use App\Models\TransactionHeader;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarketplaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_renders_with_services(): void
    {
        Service::factory()->count(3)->create();

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertInertia(fn ($page) => $page->component('Home')->has('services', 3));
    }

    public function test_explore_pagates_services_and_categories(): void
    {
        Category::factory()->count(3)->create();
        Service::factory()->count(3)->create();

        $response = $this->get(route('explore'));

        $response->assertOk();
        $response->assertInertia(fn ($page) => $page->component('Explore')->has('categories', 3));
    }

    public function test_service_detail_renders_reviews_and_related(): void
    {
        $service = Service::factory()->create();

        $response = $this->get(route('services.show', $service->id));

        $response->assertOk();
        $response->assertInertia(fn ($page) => $page->component('Services/Show')->where('service.id', $service->id));
    }

    public function test_search_requires_keyword(): void
    {
        $this->get(route('search'))->assertSessionHasErrors('keyword');
    }

    public function test_guest_cannot_create_service(): void
    {
        $this->get(route('services.create'))->assertRedirect('/login');
    }

    public function test_authenticated_user_can_create_service(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->post(route('services.store'), [
            'name' => 'Logo Design',
            'description' => 'I will design a logo for your business.',
            'category_id' => $category->id,
            'price' => 50,
        ]);

        $response->assertRedirect(route('orders'));
        $this->assertDatabaseHas('services', ['name' => 'Logo Design', 'user_id' => $user->id]);
    }

    public function test_users_can_only_edit_their_own_services(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $service = Service::factory()->for($owner)->create();

        $this->actingAs($other)->get(route('services.edit', $service->id))->assertForbidden();
    }

    public function test_review_can_be_posted_by_authenticated_user(): void
    {
        $user = User::factory()->create();
        $service = Service::factory()->for(User::factory())->create();

        $response = $this->actingAs($user)->post(route('reviews.store', $service->id), [
            'title' => 'Great work',
            'description' => 'Very satisfied.',
            'rating' => 5,
        ]);

        $response->assertRedirect(route('services.show', $service->id));
        $this->assertDatabaseHas('reviews', ['service_id' => $service->id, 'rating' => 5]);
    }

    public function test_review_rating_must_be_between_1_and_5(): void
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();

        $this->actingAs($user)->post(route('reviews.store', $service->id), [
            'title' => 'Bad',
            'rating' => 0,
        ])->assertSessionHasErrors('rating');
    }

    public function test_cart_can_store_and_remove_items(): void
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();

        $this->actingAs($user)->post(route('cart.store'), ['service_id' => $service->id])
            ->assertRedirect(route('cart.index'));

        $this->assertDatabaseHas('carts', ['user_id' => $user->id, 'service_id' => $service->id]);

        $cart = Cart::query()->firstWhere('service_id', $service->id);
        $this->actingAs($user)->delete(route('cart.destroy'), ['id' => $cart->id]);

        $this->assertSoftDeleted('carts', ['id' => $cart->id]);
    }

    public function test_checkout_creates_transaction_and_clears_cart(): void
    {
        $buyer = User::factory()->create();
        $service = Service::factory()->create();
        Cart::factory()->for($buyer)->for($service)->create();

        $response = $this->actingAs($buyer)->post(route('cart.checkout'), ['payment_type' => 'Credit']);

        $response->assertRedirect(route('orders'));
        $this->assertDatabaseHas('transaction_headers', ['user_id' => $buyer->id, 'payment_type' => 'Credit']);
        $this->assertDatabaseHas('transaction_details', ['service_id' => $service->id]);
        $this->assertSoftDeleted('carts', ['user_id' => $buyer->id]);
    }

    public function test_seller_can_mark_an_order_done(): void
    {
        $seller = User::factory()->create();
        $buyer = User::factory()->create();
        $service = Service::factory()->for($seller)->create();
        $header = TransactionHeader::factory()->for($buyer)->create();
        $detail = $header->details()->create(['service_id' => $service->id, 'status' => 'Ongoing']);

        $this->actingAs($seller)->put(route('orders.finish'), ['id' => $detail->id])
            ->assertRedirect(route('orders'));

        $this->assertSame('Done', $detail->fresh()->status);
    }
}
