<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    public function finish(Request $request): RedirectResponse
    {
        $data = $request->validate(['id' => ['required', 'exists:transaction_details,id']]);

        $detail = TransactionDetail::query()
            ->whereKey($data['id'])
            ->whereHas('service', fn ($q) => $q->where('user_id', auth()->id()))
            ->firstOrFail();

        $detail->markDone();

        return to_route('orders')->with('status', 'Order marked as done.');
    }
}
