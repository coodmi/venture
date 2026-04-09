@extends('layouts.dashboard')
@section('title', 'Investor Dashboard')
@section('page-title', 'Investor Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Profile Completion --}}
    @if($profile && $profile->profile_completion < 100)
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-amber-800">Complete your profile to get better matches</p>
            <div class="flex items-center gap-3 mt-2">
                <div class="flex-1 bg-amber-200 rounded-full h-2 w-48">
                    <div class="bg-amber-500 h-2 rounded-full" style="width: {{ $profile->profile_completion }}%"></div>
                </div>
                <span class="text-xs text-amber-700 font-medium">{{ $profile->profile_completion }}%</span>
            </div>
        </div>
        <a href="{{ route('investor.profile.edit') }}" class="bg-amber-500 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-amber-600">
            Complete Profile
        </a>
    </div>
    @endif

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @php
            $cards = [
                ['label' => 'Saved Opportunities', 'value' => $savedOpportunities->count(), 'color' => 'blue'],
                ['label' => 'Expressed Interest', 'value' => $interestedOpportunities->count(), 'color' => 'green'],
                ['label' => 'Hot Deals', 'value' => $hotDeals->count(), 'color' => 'red'],
                ['label' => 'Unread Notifications', 'value' => $notifications->count(), 'color' => 'purple'],
            ];
        @endphp
        @foreach($cards as $card)
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-sm text-gray-500">{{ $card['label'] }}</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $card['value'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Hot Deals --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-900">🔥 Hot Deals</h3>
                <a href="{{ route('investor.opportunities.index') }}" class="text-xs text-primary-600 hover:underline">View all</a>
            </div>
            @forelse($hotDeals as $deal)
            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                <div>
                    <p class="text-sm font-medium text-gray-900">{{ $deal->title }}</p>
                    <p class="text-xs text-gray-400">{{ $deal->sector }} · {{ $deal->stage }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-bold text-primary-700">${{ number_format($deal->ask_amount) }}</p>
                    <a href="{{ route('investor.opportunities.show', $deal->slug) }}" class="text-xs text-primary-600 hover:underline">View →</a>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-4">No hot deals at the moment.</p>
            @endforelse
        </div>

        {{-- Upcoming Events --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-900">📅 Upcoming Events</h3>
                <a href="{{ route('events.index') }}" class="text-xs text-primary-600 hover:underline">View all</a>
            </div>
            @forelse($upcomingEvents as $event)
            <div class="py-3 border-b border-gray-100 last:border-0">
                <p class="text-sm font-medium text-gray-900 line-clamp-1">{{ $event->title }}</p>
                <p class="text-xs text-gray-400 mt-0.5">{{ $event->start_date->format('M d, Y') }}</p>
                <p class="text-xs text-gray-400">{{ $event->venue ?? 'Online' }}</p>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-4">No upcoming events.</p>
            @endforelse
        </div>
    </div>

    {{-- Notifications --}}
    @if($notifications->count())
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-900 mb-4">🔔 Recent Notifications</h3>
        <div class="space-y-3">
            @foreach($notifications as $notif)
            <div class="flex items-start gap-3 p-3 bg-blue-50 rounded-lg">
                <div class="w-2 h-2 bg-blue-500 rounded-full mt-1.5 flex-shrink-0"></div>
                <div>
                    <p class="text-sm font-medium text-gray-900">{{ $notif->title }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $notif->message }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
