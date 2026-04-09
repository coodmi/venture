@extends('layouts.admin')
@section('title', $user->name)
@section('page-title', 'User Details')

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center">
                <span class="text-primary-700 font-bold text-xl">{{ substr($user->name, 0, 1) }}</span>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                <p class="text-gray-500">{{ $user->email }}</p>
                <div class="flex gap-2 mt-1">
                    @foreach($user->roles as $role)
                        <span class="bg-primary-50 text-primary-700 text-xs px-2 py-0.5 rounded-full">{{ $role->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.users.status', $user) }}" class="flex items-center gap-3">
            @csrf
            @method('PATCH')
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="suspended" {{ $user->status === 'suspended' ? 'selected' : '' }}>Suspended</option>
            </select>
            <button type="submit" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">Update Status</button>
        </form>
    </div>

    @if($user->investorProfile)
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-900 mb-3">Investor Profile</h3>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div><span class="text-gray-500">Type:</span> {{ $user->investorProfile->investor_type }}</div>
            <div><span class="text-gray-500">Organization:</span> {{ $user->investorProfile->organization }}</div>
            <div><span class="text-gray-500">Stage:</span> {{ $user->investorProfile->investment_stage }}</div>
            <div><span class="text-gray-500">Verification:</span> {{ $user->investorProfile->verification_status }}</div>
        </div>
    </div>
    @endif

    @if($user->seekerProfile)
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-900 mb-3">Seeker Profile</h3>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div><span class="text-gray-500">Company:</span> {{ $user->seekerProfile->company_name }}</div>
            <div><span class="text-gray-500">Industry:</span> {{ $user->seekerProfile->industry }}</div>
            <div><span class="text-gray-500">Stage:</span> {{ $user->seekerProfile->stage }}</div>
            <div><span class="text-gray-500">Location:</span> {{ $user->seekerProfile->location }}</div>
        </div>
    </div>
    @endif
</div>
@endsection
