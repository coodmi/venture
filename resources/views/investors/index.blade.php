@extends('layouts.app')
@section('title', 'Investors')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-gray-950 via-primary-950 to-primary-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            <span class="inline-flex items-center gap-1.5 bg-white/10 text-white/80 text-xs font-semibold px-3 py-1 rounded-full mb-5 border border-white/20">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>
                Investment Community
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight mb-4">Meet Our <span class="text-accent-400">Investors</span></h1>
            <p class="text-white/60 text-lg max-w-xl">Connect with verified investors — from angels to VCs, corporate ventures to impact funds — all actively seeking opportunities in Bangladesh.</p>
        </div>
    </div>
</section>

{{-- Stats Bar --}}
<section class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-3 md:grid-cols-5 divide-x divide-gray-100">
            @php
                $catSvg = [
                    'angel'         => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
                    'vc'            => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
                    'corporate'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    'family_office' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
                    'impact'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>',
                ];
                $catAccent = ['angel'=>'text-amber-500','vc'=>'text-primary-600','corporate'=>'text-blue-600','family_office'=>'text-purple-600','impact'=>'text-green-600'];
            @endphp
            @foreach($types as $key => $label)
            <a href="{{ route('investors.index', ['type'=>$key]) }}"
               class="group flex flex-col items-center py-5 px-4 hover:bg-gray-50 transition-colors {{ request('type')===$key ? 'bg-primary-50' : '' }}">
                <svg class="w-6 h-6 mb-2 {{ $catAccent[$key] }} {{ request('type')===$key ? '' : 'opacity-60 group-hover:opacity-100' }} transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $catSvg[$key] !!}
                </svg>
                <span class="text-2xl font-extrabold {{ request('type')===$key ? 'text-primary-700' : 'text-gray-900' }}">{{ $counts[$key] ?? 0 }}</span>
                <span class="text-xs text-gray-500 mt-0.5 text-center">{{ $label }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Filters --}}
        <form method="GET" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 mb-8 flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-medium text-gray-500 mb-1">Search</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or organization..."
                        class="w-full border border-gray-300 rounded-lg pl-9 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
            </div>
            <div class="min-w-[160px]">
                <label class="block text-xs font-medium text-gray-500 mb-1">Investor Type</label>
                <select name="type" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="">All Types</option>
                    @foreach($types as $k => $v)
                    <option value="{{ $k }}" {{ request('type')===$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="min-w-[150px]">
                <label class="block text-xs font-medium text-gray-500 mb-1">Investment Stage</label>
                <select name="stage" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="">All Stages</option>
                    @foreach($stages as $k => $v)
                    <option value="{{ $k }}" {{ request('stage')===$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-primary-600 text-white font-medium px-5 py-2 rounded-lg hover:bg-primary-700 text-sm">Filter</button>
            @if(request()->hasAny(['search','type','stage']))
            <a href="{{ route('investors.index') }}" class="text-sm text-gray-400 hover:text-red-500 py-2">✕ Clear</a>
            @endif
        </form>

        <div class="flex items-center justify-between mb-5">
            <p class="text-sm text-gray-500">{{ $investors->total() }} investor{{ $investors->total()!=1?'s':'' }} found</p>
        </div>

        @if($investors->isEmpty())
        <div class="text-center py-24 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <p class="text-lg font-medium">No investors found</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($investors as $inv)
            @php
                $typeBadge = ['angel'=>'bg-amber-50 text-amber-700 border-amber-200','vc'=>'bg-primary-50 text-primary-700 border-primary-200','corporate'=>'bg-blue-50 text-blue-700 border-blue-200','family_office'=>'bg-purple-50 text-purple-700 border-purple-200','impact'=>'bg-green-50 text-green-700 border-green-200'];
                $typeLabel = ['angel'=>'Angel','vc'=>'Venture Capital','corporate'=>'Corporate','family_office'=>'Family Office','impact'=>'Impact'];
                $stageLabel = ['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
                $avatarBg = ['angel'=>'from-amber-400 to-orange-500','vc'=>'from-primary-500 to-primary-700','corporate'=>'from-blue-500 to-indigo-600','family_office'=>'from-purple-500 to-pink-600','impact'=>'from-green-500 to-teal-600'];
            @endphp
            <a href="{{ route('investors.show', $inv->id) }}"
               class="group bg-white rounded-2xl border border-gray-200 hover:border-primary-300 hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col">

                {{-- Top accent bar --}}
                <div class="h-1 w-full bg-gradient-to-r {{ $avatarBg[$inv->investor_type] ?? 'from-primary-500 to-primary-700' }}"></div>

                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $avatarBg[$inv->investor_type] ?? 'from-primary-500 to-primary-700' }} flex items-center justify-center text-white font-bold text-base flex-shrink-0 shadow-sm">
                            {{ strtoupper(substr($inv->user->name ?? 'IN', 0, 2)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-1.5">
                                <h3 class="font-bold text-gray-900 group-hover:text-primary-600 transition-colors truncate text-sm">{{ $inv->user->name }}</h3>
                                @if($inv->verification_status === 'verified')
                                <svg class="w-4 h-4 text-primary-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500 truncate">{{ $inv->designation }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ $inv->organization }}</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-1.5 mb-3">
                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full border {{ $typeBadge[$inv->investor_type] ?? 'bg-gray-100 text-gray-600 border-gray-200' }}">
                            {{ $typeLabel[$inv->investor_type] ?? $inv->investor_type }}
                        </span>
                        @if($inv->investment_stage)
                        <span class="text-xs bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-full border border-gray-200">{{ $stageLabel[$inv->investment_stage] ?? $inv->investment_stage }}</span>
                        @endif
                    </div>

                    @if($inv->bio)
                    <p class="text-xs text-gray-500 line-clamp-2 flex-1 mb-4 leading-relaxed">{{ $inv->bio }}</p>
                    @endif

                    <div class="pt-4 border-t border-gray-100 space-y-2">
                        @if($inv->sector_preferences)
                        <div class="flex flex-wrap gap-1">
                            @foreach(array_slice($inv->sector_preferences, 0, 3) as $sector)
                            <span class="text-xs bg-primary-50 text-primary-600 px-2 py-0.5 rounded-md font-medium">{{ $sector }}</span>
                            @endforeach
                        </div>
                        @endif
                        @if($inv->ticket_size_min && $inv->ticket_size_max)
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-400">Ticket Size</span>
                            <span class="text-xs font-semibold text-gray-700">৳{{ number_format($inv->ticket_size_min/100000, 0) }}L – ৳{{ number_format($inv->ticket_size_max/100000, 0) }}L</span>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-10">{{ $investors->withQueryString()->links() }}</div>
        @endif
    </div>
</section>
@endsection
