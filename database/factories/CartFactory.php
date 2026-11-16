<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cart>
 */
class CartFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'service_id' => Service::query()->inRandomOrder()->value('id') ?? Service::factory(),
            'notes' => fake()->optional(0.3)->sentence(),
        ];
    }
}
