<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, int $id): RedirectResponse
    {
        $service = Service::query()->whereKey($id)->firstOrFail();

        $data = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:1000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'service_id' => $service->id,
            ...$data,
        ]);

        return to_route('services.show', $service->id)->with('status', 'Review posted.');
    }
}
