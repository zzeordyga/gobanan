<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Review;
use App\Models\Service;
use App\Models\TransactionHeader;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Index', [
            'stats' => [
                'users' => User::query()->count(),
                'services' => Service::query()->count(),
                'categories' => Category::query()->count(),
                'transactions' => TransactionHeader::query()->count(),
                'reviews' => Review::query()->count(),
            ],
        ]);
    }

    public function categories(): Response
    {
        $categories = Category::query()
            ->withCount('services')
            ->latest()
            ->paginate(10)
            ->through(fn (Category $c) => [
                'id' => $c->id,
                'name' => $c->name,
                'description' => $c->description,
                'servicesCount' => $c->services_count,
                'timesVisited' => $c->times_visited,
            ]);

        return Inertia::render('Admin/Categories/Index', ['categories' => $categories]);
    }

    public function reviews(): Response
    {
        $reviews = Review::query()
            ->with(['user:id,name', 'service:id,name'])
            ->latest()
            ->paginate(10)
            ->through(fn (Review $r) => [
                'id' => $r->id,
                'title' => $r->title,
                'rating' => $r->rating,
                'user' => $r->user?->only(['id', 'name']),
                'service' => $r->service?->only(['id', 'name']),
            ]);

        return Inertia::render('Admin/Reviews', ['reviews' => $reviews]);
    }

    public function services(): Response
    {
        $services = Service::query()
            ->with(['user:id,name', 'category:id,name'])
            ->latest()
            ->paginate(10)
            ->through(fn (Service $s) => [
                'id' => $s->id,
                'name' => $s->name,
                'price' => (float) $s->price,
                'user' => $s->user?->only(['id', 'name']),
                'category' => $s->category?->only(['id', 'name']),
            ]);

        return Inertia::render('Admin/Services', ['services' => $services]);
    }

    public function transactions(): Response
    {
        $headers = TransactionHeader::query()
            ->with(['user:id,name', 'details'])
            ->latest()
            ->paginate(10)
            ->through(fn (TransactionHeader $h) => [
                'id' => $h->id,
                'paymentType' => $h->payment_type,
                'items' => $h->details->count(),
                'user' => $h->user?->only(['id', 'name']),
            ]);

        return Inertia::render('Admin/Transactions/Index', ['headers' => $headers]);
    }

    public function transactionDetails(int $id): Response
    {
        $header = TransactionHeader::query()
            ->whereKey($id)
            ->with(['user:id,name', 'details.service.user:id,name', 'details.service.category:id,name'])
            ->firstOrFail();

        return Inertia::render('Admin/Transactions/Show', [
            'header' => [
                'id' => $header->id,
                'paymentType' => $header->payment_type,
                'user' => $header->user?->only(['id', 'name']),
                'details' => $header->details->map(fn ($d) => [
                    'id' => $d->id,
                    'status' => $d->status,
                    'notes' => $d->notes,
                    'service' => $d->service?->only(['id', 'name']),
                    'seller' => $d->service?->user?->only(['id', 'name']),
                ]),
            ],
        ]);
    }

    public function users(): Response
    {
        $users = User::query()
            ->latest()
            ->paginate(10)
            ->through(fn (User $u) => [
                'id' => $u->id,
                'name' => $u->name,
                'username' => $u->username,
                'email' => $u->email,
                'role' => $u->role,
            ]);

        return Inertia::render('Admin/Users', ['users' => $users]);
    }
}
