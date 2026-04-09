<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roles');

        if ($request->filled('role')) {
            $query->role($request->role);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['roles', 'investorProfile', 'seekerProfile', 'memberships.plan']);
        return view('admin.users.show', compact('user'));
    }

    public function updateStatus(Request $request, User $user)
    {
        $request->validate(['status' => 'required|in:active,suspended,pending']);
        $user->update(['status' => $request->status]);
        return back()->with('success', 'User status updated.');
    }
}
