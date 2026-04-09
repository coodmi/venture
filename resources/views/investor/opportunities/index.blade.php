@extends('layouts.dashboard')
@section('title', 'Browse Opportunities')
@section('page-title', 'Browse Opportunities')

@section('content')
<div class="space-y-6">

    {{-- Filters --}}
    <div class="bg-white rounded-xl border border-gray-200 p-4">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search opportunities..."
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 w-48">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Sector</label>
                <select name="sector" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="">All Sectors</option>
                    @foreach(['Technology', 'FinTech', 'HealthTech', 'EdTech', 'AgriTech', 'CleanTech', 'E-Commerce', 'Real Estate', 'Manufacturing', 'Logistics', 'Media', 'Other'] as $s)
                        <option value="{{ $s }}" {{ request('sector') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Stage</label>
                <select name="stage" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="">All Stages</option>
                    @foreach(['Idea', 'MVP', 'Early Stage', 'Growth', 'Scale'] as $s)
                        <option value="{{ $s }}" {{ request('stage') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">Filter</button>
            <a href="{{ route('investor.opportunities.index') }}" class="text-sm text-gray-500 hover:text-gray-700 py-2">Clear</a>
        </form>
    </div>

    {{-- Results --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($opportunities as $opp)
        <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="bg-primary-50 text-primary-700 text-xs font-semibold px-2 py-1 rounded-full">{{ $opp->stage }}</span>
                <div class="flex gap-1">
                    @if($opp->is_hot_deal)
                        <span class="bg-red-50 text-red-600 text-xs font-semibold px-2 py-1 rounded-full">🔥 Hot</span>
                    @endif
                    @if($opp->is_featured)
                        <span class="bg-amber-50 text-amber-600 text-xs font-semibold px-2 py-1 rounded-full">⭐</span>
                    @endif
                </div>
            </div>
            <h3 class="font-semibold text-gray-900 mb-1">{{ $opp->title }}</h3>
            <p class="text-xs text-gray-400 mb-3">{{ $opp->sector }} · {{ $opp->location }}</p>
            <p class="text-sm text-gray-600 line-clamp-2 mb-4">{{ $opp->solution }}</p>
            <div class="flex items-center justify-between">
                <span class="text-primary-700 font-bold text-sm">${{ number_format($opp->ask_amount) }}</span>
                <a href="{{ route('investor.opportunities.show', $opp->slug) }}"
                   class="bg-primary-600 text-white text-xs font-medium px-3 py-1.5 rounded-lg hover:bg-primary-700">
                    View Details
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-16 text-gray-400">
            <p class="text-lg mb-2">No opportunities found</p>
            <p class="text-sm">Try adjusting your filters</p>
        </div>
        @endforelse
    </div>

    {{ $opportunities->withQueryString()->links() }}
</div>
@endsection
