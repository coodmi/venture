@extends('layouts.admin')
@section('title', 'Users')
@section('page-title', 'User Management')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="p-4 border-b border-gray-200 flex items-center justify-between">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..."
                   class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
            <select name="role" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                <option value="">All Roles</option>
                <option value="investor" {{ request('role') === 'investor' ? 'selected' : '' }}>Investor</option>
                <option value="seeker" {{ request('role') === 'seeker' ? 'selected' : '' }}>Seeker</option>
                <option value="member" {{ request('role') === 'member' ? 'selected' : '' }}>Member</option>
            </select>
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                <option value="">All Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
            </select>
            <button type="submit" class="bg-primary-600 text-white text-sm px-4 py-2 rounded-lg">Filter</button>
        </form>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">Role</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Joined</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $user->email }}</td>
                <td class="px-4 py-3">
                    @foreach($user->roles as $role)
                        <span class="bg-primary-50 text-primary-700 text-xs px-2 py-0.5 rounded-full">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td class="px-4 py-3">
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                        {{ $user->status === 'active' ? 'bg-green-100 text-green-700' :
                           ($user->status === 'suspended' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                <td class="px-4 py-3">
                    <a href="{{ route('admin.users.show', $user) }}" class="text-primary-600 hover:underline text-xs">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $users->links() }}</div>
</div>
@endsection
