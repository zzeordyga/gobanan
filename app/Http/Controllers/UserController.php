<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function makeAdmin(int $id): RedirectResponse
    {
        $user = User::query()->whereKey($id)->firstOrFail();
        $user->update(['role' => 'admin']);

        return to_route('admin.users.index')->with('status', "{$user->name} is now an admin.");
    }

    public function makeMember(int $id): RedirectResponse
    {
        $user = User::query()->whereKey($id)->firstOrFail();
        abort_unless($user->id !== (int) auth()->id(), 403, 'You cannot demote yourself.');

        $user->update(['role' => 'member']);

        return to_route('admin.users.index')->with('status', "{$user->name} is now a member.");
    }
}
