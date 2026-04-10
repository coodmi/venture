@extends('layouts.app')
@section('title', 'Top Startups')
@section('meta_description', 'Discover and invest in top startups on VentureMatch.')

@section('content')
<section class="bg-gradient-to-br from-primary-950 to-primary-800 text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block bg-primary-700/50 text-primary-200 text-xs font-semibold px-3 py-1 rounded-full mb-4 border border-primary-600">🚀 Investment Opportunities</span>
        <h1 class="text-4xl font-extrabold mb-3">Top Startups</h1>
        <p class="text-primary-200 max-w-xl mx-auto">Discover high-potential startups seeking investment. Browse, explore, and connect with founders.</p>
    </div>
</section>

<section class="py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Filters --}}
        <form method="GET" class="bg-white rounded-2xl border border-gray-200 p-4 mb-8 flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-[180px]">
                <label class="block text-xs font-medium text-gray-500 mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search startups..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
            <div class="min-w-[150px]">
                <label class="block text-xs font-medium text-gray-500 mb-1">Sector</label>
                <select name="sector" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="">All Sectors</option>
                    @foreach($sectors as $s)
                    <option value="{{ $s }}" {{ request('sector')===$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="min-w-[150px]">
                <label class="block text-xs font-medium text-gray-500 mb-1">Stage</label>
                <select name="stage" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="">All Stages</option>
                    @foreach($stages as $s)
                    <option value="{{ $s }}" {{ request('stage')===$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-primary-600 text-white font-medium px-5 py-2 rounded-lg hover:bg-primary-700 text-sm">Filter</button>
            @if(request()->hasAny(['search','sector','stage']))
            <a href="{{ route('startups.index') }}" class="text-sm text-gray-500 hover:text-red-500 py-2">Clear</a>
            @endif
        </form>

        {{-- Results count --}}
        <p class="text-sm text-gray-500 mb-5">{{ $opportunities->total() }} startup{{ $opportunities->total()!=1?'s':'' }} found</p>

        @if($opportunities->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            <p class="text-lg font-medium">No startups found</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($opportunities as $opp)
            <a href="{{ route('startups.show', $opp->slug) }}"
               class="group bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <span class="text-primary-700 font-bold text-lg">{{ strtoupper(substr($opp->title,0,2)) }}</span>
                    </div>
                    <div class="flex gap-2 flex-wrap justify-end">
                        @if($opp->is_featured)
                        <span class="text-xs bg-amber-100 text-amber-700 font-semibold px-2 py-0.5 rounded-full">⭐ Featured</span>
                        @endif
                        @if($opp->is_hot_deal)
                        <span class="text-xs bg-red-100 text-red-600 font-semibold px-2 py-0.5 rounded-full">🔥 Hot Deal</span>
                        @endif
                    </div>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-1 group-hover:text-primary-600 transition-colors line-clamp-2">{{ $opp->title }}</h3>
                <div class="flex flex-wrap gap-2 mb-3">
                    @if($opp->sector)<span class="text-xs bg-primary-50 text-primary-700 px-2 py-0.5 rounded-full font-medium">{{ $opp->sector }}</span>@endif
                    @if($opp->stage)<span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">{{ $opp->stage }}</span>@endif
                    @if($opp->location)<span class="text-xs text-gray-400">📍 {{ $opp->location }}</span>@endif
                </div>
                <p class="text-sm text-gray-500 line-clamp-3 flex-1 mb-4">{{ $opp->business_problem }}</p>
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    @if($opp->ask_amount)
                    <div>
                        <p class="text-xs text-gray-400">Seeking</p>
                        <p class="font-bold text-primary-700">৳{{ number_format($opp->ask_amount) }}</p>
                    </div>
                    @endif
                    <span class="text-xs text-primary-600 font-semibold group-hover:underline">View Details →</span>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-10">{{ $opportunities->withQueryString()->links() }}</div>
        @endif
    </div>
</section>
@endsection
