<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    public function index(): Response
    {
        $carts = Cart::query()
            ->where('user_id', auth()->id())
            ->with(['service.user:id,name', 'service.category:id,name'])
            ->latest()
            ->get()
            ->map(fn (Cart $c) => [
                'id' => $c->id,
                'notes' => $c->notes,
                'service' => [
                    'id' => $c->service?->id,
                    'name' => $c->service?->name,
                    'price' => (float) $c->service?->price,
                    'picture' => $c->service?->pictureUrl(),
                    'seller' => ['id' => $c->service?->user?->id, 'name' => $c->service?->user?->name],
                ],
            ]);

        $total = $carts->sum(fn (array $c) => $c['service']['price'] ?? 0);

        return Inertia::render('Cart', ['carts' => $carts, 'total' => $total]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        Cart::create([
            'user_id' => auth()->id(),
            'service_id' => $data['service_id'],
            'notes' => $data['notes'] ?? null,
        ]);

        return to_route('cart.index')->with('status', 'Added to cart.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $data = $request->validate(['id' => ['required', 'exists:carts,id']]);

        $cart = Cart::query()->whereKey($data['id'])->first();
        abort_unless($cart && $cart->user_id === (int) auth()->id(), 403);

        $cart->delete();

        return to_route('cart.index')->with('status', 'Removed from cart.');
    }

    public function checkout(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'payment_type' => ['required', 'string', 'in:Debit,Credit,Bank Transfer,E-Wallet'],
        ]);

        $carts = Cart::query()
            ->where('user_id', auth()->id())
            ->with('service')
            ->get();

        if ($carts->isEmpty()) {
            return to_route('cart.index')->with('status', 'Your cart is empty.');
        }

        DB::transaction(function () use ($carts, $data) {
            $header = TransactionHeader::create([
                'user_id' => auth()->id(),
                'payment_type' => $data['payment_type'],
            ]);

            foreach ($carts as $cart) {
                TransactionDetail::create([
                    'header_id' => $header->id,
                    'service_id' => $cart->service_id,
                    'notes' => $cart->notes,
                    'status' => 'Ongoing',
                ]);
                $cart->delete();
            }
        });

        return to_route('orders')->with('status', 'Checkout complete.');
    }
}
