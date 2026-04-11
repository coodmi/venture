@extends('layouts.admin')
@section('title', 'Users')
@section('page-title', 'User Management')

@section('content')
<div style="background:#1a1408;" class=" rounded-xl border border-gray-200 overflow-hidden">
    <div class="p-4 border-b border-gray-200 flex items-center justify-between">
        <form method="GET" style="display:flex;gap:.75rem;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..."
                   style="background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#c9b48a;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;">
            <select name="role" style="background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#c9b48a;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;">
                <option value="">All Roles</option>
                <option value="investor" {{ request('role') === 'investor' ? 'selected' : '' }}>Investor</option>
                <option value="seeker" {{ request('role') === 'seeker' ? 'selected' : '' }}>Seeker</option>
                <option value="member" {{ request('role') === 'member' ? 'selected' : '' }}>Member</option>
            </select>
            <select name="status" style="background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#c9b48a;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;">
                <option value="">All Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
            </select>
            <button type="submit" class="bg-primary-600 text-white text-sm px-4 py-2 rounded-lg">Filter</button>
        </form>
    </div>
    <table style="width:100%;font-size:.875rem;border-collapse:collapse;">
        <thead style="background:#110e05;" style="background:#110e05;">
            <tr>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Name</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Email</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Role</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Status</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Joined</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Actions</th>
            </tr>
        </thead>
        <tbody >
            @foreach($users as $user)
            <tr onmouseover="this.style.background='rgba(212,146,15,.04)';" onmouseout="this.style.background='transparent';">
                <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                <td style="padding:.75rem 1rem;color:#7a6a4a;border-bottom:1px solid rgba(212,146,15,.06);">{{ $user->email }}</td>
                <td style="padding:.75rem 1rem;border-bottom:1px solid rgba(212,146,15,.06);">
                    @foreach($user->roles as $role)
                        <span class="bg-primary-50 text-primary-700 text-xs px-2 py-0.5 rounded-full">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td style="padding:.75rem 1rem;border-bottom:1px solid rgba(212,146,15,.06);">
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                        {{ $user->status === 'active' ? 'bg-green-100 text-green-700' :
                           ($user->status === 'suspended' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                <td style="padding:.75rem 1rem;border-bottom:1px solid rgba(212,146,15,.06);">
                    <a href="{{ route('admin.users.show', $user) }}" style="color:#d4920f;text-decoration:none;font-size:.75rem;font-weight:600;">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $users->links() }}</div>
</div>
@endsection
