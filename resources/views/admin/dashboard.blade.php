@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        @php
            $statCards = [
                ['label' => 'Total Users',       'value' => $stats['total_users'],          'color' => 'blue'],
                ['label' => 'Investors',          'value' => $stats['total_investors'],       'color' => 'green'],
                ['label' => 'Seekers',            'value' => $stats['total_seekers'],         'color' => 'purple'],
                ['label' => 'Opportunities',      'value' => $stats['total_opportunities'],   'color' => 'amber'],
                ['label' => 'Pending Review',     'value' => $stats['pending_opportunities'], 'color' => 'red'],
            ];
        @endphp
        @foreach($statCards as $card)
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-xs text-gray-500 uppercase tracking-wider">{{ $card['label'] }}</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $card['value'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Recent Users --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-900">Recent Users</h3>
                <a href="{{ route('admin.users.index') }}" class="text-xs text-primary-600 hover:underline">View all</a>
            </div>
            @foreach($recentUsers as $user)
            <div class="flex items-center gap-3 py-2 border-b border-gray-100 last:border-0">
                <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-primary-700 font-semibold text-xs">{{ substr($user->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                </div>
                <span class="text-xs px-2 py-0.5 rounded-full
                    {{ $user->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                    {{ $user->status }}
                </span>
            </div>
            @endforeach
        </div>

        {{-- Recent Opportunities --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-900">Recent Opportunities</h3>
                <a href="{{ route('admin.opportunities.index') }}" class="text-xs text-primary-600 hover:underline">View all</a>
            </div>
            @foreach($recentOpportunities as $opp)
            <div class="py-2 border-b border-gray-100 last:border-0">
                <p class="text-sm font-medium text-gray-900 truncate">{{ $opp->title }}</p>
                <div class="flex items-center justify-between mt-0.5">
                    <p class="text-xs text-gray-400">{{ $opp->user->name }}</p>
                    <span class="text-xs px-2 py-0.5 rounded-full
                        {{ $opp->status === 'approved' ? 'bg-green-100 text-green-700' :
                           ($opp->status === 'submitted' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600') }}">
                        {{ ucfirst($opp->status) }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pending Memberships --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-900">Pending Memberships</h3>
                <a href="{{ route('admin.memberships.index') }}" class="text-xs text-primary-600 hover:underline">View all</a>
            </div>
            @forelse($pendingMemberships as $m)
            <div class="py-2 border-b border-gray-100 last:border-0">
                <p class="text-sm font-medium text-gray-900">{{ $m->user->name }}</p>
                <p class="text-xs text-gray-400">{{ $m->plan->name }}</p>
                <a href="{{ route('admin.memberships.show', $m) }}" class="text-xs text-primary-600 hover:underline">Review →</a>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-4">No pending memberships.</p>
            @endforelse
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-900 mb-4">Quick Actions</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.news.create') }}" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">+ Add News</a>
            <a href="{{ route('admin.events.create') }}" class="bg-green-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-green-700">+ Add Event</a>
            <a href="{{ route('admin.opportunities.index') }}?status=submitted" class="bg-amber-500 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-amber-600">Review Opportunities</a>
            <a href="{{ route('admin.settings.stats') }}" class="bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-700">Update Stats</a>
        </div>
    </div>

</div>
@endsection
