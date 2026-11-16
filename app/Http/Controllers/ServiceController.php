<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ServiceController extends Controller
{
    /**
     * Marketplace landing — hero + curated services.
     */
    public function index(): Response
    {
        $services = Service::query()
            ->inRandomOrder()
            ->take(6)
            ->with(['user:id,name,picture', 'category:id,name'])
            ->get()
            ->map(fn (Service $s) => $this->toCard($s));

        return Inertia::render('Home', ['services' => $services]);
    }

    public function explore(Request $request): Response
    {
        $categories = Category::query()->orderBy('name')->get(['id', 'name']);

        $services = Service::query()
            ->when($request->integer('category'), fn ($q, $id) => $q->where('category_id', $id))
            ->with(['user:id,name,picture', 'category:id,name'])
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $relatedPaginator = $this->transformPaginated($services);
        $relatedServices = $relatedPaginator->through(fn ($item) => $this->toCard($item));

        return Inertia::render('Explore', [
            'services' => $relatedServices,
            'categories' => $categories,
            'currentCategory' => null,
        ]);
    }

    public function category(int $id): Response
    {
        $category = Category::query()->whereKey($id)->firstOrFail(['id', 'name']);
        $services = Service::query()
            ->where('category_id', $id)
            ->with(['user:id,name,picture', 'category:id,name'])
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $scoped = $services->through(fn (Service $s) => $this->toCard($s));

        return Inertia::render('Explore', [
            'services' => $scoped,
            'categories' => Category::query()->orderBy('name')->get(['id', 'name']),
            'currentCategory' => $category->only(['id', 'name']),
        ]);
    }

    public function show(int $id): Response
    {
        $service = Service::query()
            ->whereKey($id)
            ->with(['user', 'category', 'reviews.user:id,name,picture'])
            ->firstOrFail();

        $service->category?->increment('times_visited');

        $related = Service::query()
            ->where('category_id', $service->category_id)
            ->whereKeyNot($service->id)
            ->inRandomOrder()
            ->take(4)
            ->with(['user:id,name,picture'])
            ->get()
            ->map(fn (Service $s) => $this->toCard($s));

        return Inertia::render('Services/Show', [
            'service' => $this->toDetail($service),
            'related' => $related,
        ]);
    }

    public function search(Request $request): Response
    {
        $data = $request->validate(['keyword' => ['required', 'string', 'min:2']]);

        $services = Service::query()
            ->where(fn ($q) => $q->where('name', 'like', "%{$data['keyword']}%")
                ->orWhere('description', 'like', "%{$data['keyword']}%"))
            ->orWhereHas('user', fn ($q) => $q->where('name', 'like', "%{$data['keyword']}%"))
            ->orWhereHas('category', fn ($q) => $q->where('name', 'like', "%{$data['keyword']}%"))
            ->with(['user:id,name,picture', 'category:id,name'])
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $scoped = $services->through(fn (Service $s) => $this->toCard($s));

        return Inertia::render('Search', [
            'keyword' => $data['keyword'],
            'services' => $scoped,
        ]);
    }

    public function userServices(int $id): Response
    {
        $user = User::query()->whereKey($id)->firstOrFail(['id', 'name', 'username', 'email', 'picture']);
        $services = Service::query()
            ->where('user_id', $id)
            ->with(['category:id,name'])
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return Inertia::render('Users/Show', [
            'seller' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'picture' => $user->profilePictureUrl(),
                'serviceCount' => Service::query()->where('user_id', $id)->count(),
                'rating' => $user->reviewRating(),
                'reviewCount' => $user->reviewCount(),
            ],
            'services' => $services->through(fn (Service $s) => $s->only(['id', 'name', 'price']) + ['card' => $this->toCard($s->load('user'))]),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Services/Create', [
            'categories' => Category::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function edit(int $id): Response
    {
        $service = Service::query()->whereKey($id)->firstOrFail();
        abort_unless($service->user_id === (int) auth()->id(), 403);

        return Inertia::render('Services/Edit', [
            'service' => $service->only(['id', 'name', 'description', 'price', 'category_id', 'picture']) + ['pictureUrl' => $service->pictureUrl()],
            'categories' => Category::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateService($request);
        $data['user_id'] = auth()->id();
        $data['picture'] = $this->storePicture($request);

        Service::create($data);

        return to_route('orders')->with('status', 'Service created.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $service = Service::query()->whereKey($id)->firstOrFail();
        abort_unless($service->user_id === (int) auth()->id(), 403);

        $data = $this->validateService($request);
        $data['picture'] = $this->storePicture($request, $service->picture);

        $service->update($data);

        return to_route('orders')->with('status', 'Service updated.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $service = Service::query()->whereKey($id)->firstOrFail();
        abort_unless($service->user_id === (int) auth()->id(), 403);

        $service->delete();

        return to_route('orders')->with('status', 'Service deleted.');
    }

    public function orders(): Response
    {
        $userId = auth()->id();

        $orders = TransactionDetail::query()
            ->whereHas('service', fn ($q) => $q->where('user_id', $userId))
            ->with(['service.user:id,name', 'header.user:id,name'])
            ->latest()
            ->paginate(8, ['*'], 'orders_page')
            ->through(fn (TransactionDetail $d) => [
                'id' => $d->id,
                'status' => $d->status,
                'service' => ['id' => $d->service?->id, 'name' => $d->service?->name],
                'buyer' => ['id' => $d->header?->user?->id, 'name' => $d->header?->user?->name],
            ]);

        $purchases = TransactionDetail::query()
            ->whereHas('header', fn ($q) => $q->where('user_id', $userId))
            ->with(['service.user:id,name', 'service.category:id,name'])
            ->latest()
            ->paginate(8, ['*'], 'purchases_page')
            ->through(fn (TransactionDetail $d) => [
                'id' => $d->id,
                'status' => $d->status,
                'service' => ['id' => $d->service?->id, 'name' => $d->service?->name],
                'seller' => ['id' => $d->service?->user?->id, 'name' => $d->service?->user?->name],
            ]);

        return Inertia::render('Orders', ['orders' => $orders, 'purchases' => $purchases]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validateService(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:2000'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:1', 'max:999999.999'],
            'picture' => ['nullable', 'image', 'max:2048'],
        ]);
    }

    private function storePicture(Request $request, ?string $previous = null): ?string
    {
        if (! $request->hasFile('picture')) {
            return $previous;
        }

        $path = $request->file('picture')->store('service-images', 'public');
        if ($previous && str_starts_with($previous, 'service-images/')) {
            Storage::disk('public')->delete($previous);
        }

        return $path;
    }

    private function transformPaginated($paginator)
    {
        return $paginator;
    }

    /**
     * @return array<string, mixed>
     */
    private function toCard(Service $s): array
    {
        return [
            'id' => $s->id,
            'name' => $s->name,
            'price' => (float) $s->price,
            'rating' => $s->reviewRating(),
            'reviewCount' => $s->reviewCount(),
            'picture' => $s->pictureUrl(),
            'seller' => [
                'id' => $s->user?->id,
                'name' => $s->user?->name,
                'picture' => $s->user?->profilePictureUrl(),
            ],
            'category' => $s->category?->only(['id', 'name']),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function toDetail(Service $s): array
    {
        return [
            'id' => $s->id,
            'name' => $s->name,
            'description' => $s->description,
            'price' => (float) $s->price,
            'rating' => $s->reviewRating(),
            'reviewCount' => $s->reviewCount(),
            'picture' => $s->pictureUrl(),
            'seller' => ['id' => $s->user?->id, 'name' => $s->user?->name, 'picture' => $s->user?->profilePictureUrl()],
            'category' => $s->category?->only(['id', 'name', 'description']),
            'reviews' => $s->reviews->map(fn ($r) => [
                'id' => $r->id,
                'title' => $r->title,
                'description' => $r->description,
                'rating' => $r->rating,
                'user' => ['id' => $r->user?->id, 'name' => $r->user?->name, 'picture' => $r->user?->profilePictureUrl()],
            ]),
        ];
    }
}
