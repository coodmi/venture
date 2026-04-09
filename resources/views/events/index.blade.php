@extends('layouts.app')
@section('title', 'Events & Conferences — VentureMatch')
@section('meta_description', 'Attend VentureMatch events — investor summits, startup showcases, networking nights, and ecosystem conferences.')

@section('content')

{{-- Hero --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-20 w-80 h-80 bg-accent-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-primary-200 text-xs font-semibold px-4 py-1.5 rounded-full mb-6 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 bg-accent-400 rounded-full"></span>
                Events & Conferences
            </span>
            <h1 class="text-5xl sm:text-6xl font-extrabold leading-tight mb-6 tracking-tight">
                Where Deals Are<br>
                <span class="text-accent-400">Made in Person</span>
            </h1>
            <p class="text-lg text-primary-200 leading-relaxed max-w-xl mb-8">
                Summits, showcases, networking nights, and workshops — designed to connect investors, founders, and ecosystem builders.
            </p>
            <div class="flex flex-wrap gap-3">
                @php $types = ['All', 'Online', 'Offline', 'Hybrid']; @endphp
                @foreach($types as $t)
                <a href="{{ $t === 'All' ? route('events.index') : route('events.index', ['type' => strtolower($t)]) }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium transition-all
                          {{ (request('type') === strtolower($t) || ($t === 'All' && !request('type'))) ? 'bg-accent-500 text-white' : 'bg-white/10 text-white hover:bg-white/20 border border-white/20' }}">
                    {{ $t }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 60L1440 60L1440 20C1200 60 960 0 720 20C480 40 240 0 0 20L0 60Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>

{{-- Featured Event Banner --}}
@php $featured = $upcoming->firstWhere('is_featured', true) ?? $upcoming->first(); @endphp
@if($featured)
<section class="bg-gray-50 py-6 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white/70 text-xs font-semibold uppercase tracking-wider">Featured Event</p>
                    <p class="text-white font-bold text-lg">{{ $featured->title }}</p>
                    <p class="text-primary-200 text-sm">{{ $featured->start_date->format('M d, Y · g:i A') }} · {{ $featured->venue ?? 'Online' }}</p>
                </div>
            </div>
            <a href="{{ route('events.show', $featured->slug) }}"
               class="bg-white text-primary-700 font-semibold px-5 py-2.5 rounded-xl text-sm hover:bg-gray-100 transition-colors flex-shrink-0">
                View Details →
            </a>
        </div>
    </div>
</section>
@endif

{{-- Upcoming Events --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <span class="text-xs font-bold text-primary-600 uppercase tracking-widest">Don't Miss Out</span>
                <h2 class="text-3xl font-extrabold text-gray-900 mt-1">Upcoming Events</h2>
            </div>
            <form method="GET" class="hidden sm:flex items-center gap-2">
                <select name="category" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                    <option value="">All Categories</option>
                    @foreach(['Summit', 'Workshop', 'Networking', 'Showcase', 'Conference', 'Bootcamp'] as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        @php
            $gradients = ['from-primary-600 to-primary-800','from-blue-600 to-indigo-700','from-purple-600 to-pink-600','from-green-600 to-teal-600','from-orange-500 to-red-600','from-amber-500 to-orange-600'];
            $icons     = ['🏆','💡','🤝','📊','🌍','🚀'];
        @endphp

        @forelse($upcoming as $event)
        @if($loop->first)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @endif

        <a href="{{ route('events.show', $event->slug) }}"
           class="group bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            @if($event->banner)
                <div class="relative overflow-hidden h-48">
                    <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="bg-white/90 backdrop-blur-sm text-primary-700 text-xs font-bold px-2.5 py-1 rounded-full">{{ ucfirst($event->event_type) }}</span>
                    </div>
                    @if($event->is_featured)
                    <div class="absolute top-3 right-3">
                        <span class="bg-accent-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">⭐ Featured</span>
                    </div>
                    @endif
                </div>
            @else
                <div class="relative h-48 bg-gradient-to-br {{ $gradients[$loop->index % count($gradients)] }} flex items-center justify-center overflow-hidden">
                    <span class="text-6xl opacity-80">{{ $icons[$loop->index % count($icons)] }}</span>
                    <div class="absolute top-3 left-3">
                        <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-bold px-2.5 py-1 rounded-full border border-white/30">{{ ucfirst($event->event_type) }}</span>
                    </div>
                    @if($event->is_featured)
                    <div class="absolute top-3 right-3">
                        <span class="bg-accent-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">⭐ Featured</span>
                    </div>
                    @endif
                </div>
            @endif

            <div class="p-5">
                <div class="flex items-center gap-2 mb-3">
                    @if($event->category)
                    <span class="text-xs bg-primary-50 text-primary-700 font-semibold px-2.5 py-1 rounded-full">{{ $event->category }}</span>
                    @endif
                    @if($event->registration_open)
                    <span class="text-xs bg-green-50 text-green-700 font-semibold px-2.5 py-1 rounded-full flex items-center gap-1">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Open
                    </span>
                    @else
                    <span class="text-xs bg-gray-100 text-gray-500 font-semibold px-2.5 py-1 rounded-full">Closed</span>
                    @endif
                </div>
                <h3 class="font-bold text-gray-900 group-hover:text-primary-600 transition-colors leading-snug mb-2">{{ $event->title }}</h3>
                @if($event->summary)
                <p class="text-xs text-gray-500 mb-3 line-clamp-2">{{ $event->summary }}</p>
                @endif
                <div class="space-y-1.5 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $event->start_date->format('M d, Y · g:i A') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $event->venue ?? 'Online Event' }}
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs text-gray-400">{{ $event->registrations_count ?? 0 }} registered</span>
                    <span class="text-primary-600 text-sm font-semibold group-hover:translate-x-1 transition-transform inline-block">View Details →</span>
                </div>
            </div>
        </a>

        @if($loop->last)
        </div>
        @endif

        @empty
        <div class="text-center py-20 text-gray-400">
            <div class="text-5xl mb-4">📅</div>
            <p class="text-lg font-medium text-gray-500">No upcoming events at the moment.</p>
            <p class="text-sm mt-1">Subscribe below to be notified when new events are announced.</p>
        </div>
        @endforelse

        {{ $upcoming->withQueryString()->links() }}
    </div>
</section>

{{-- Past Events --}}
@if($past->isNotEmpty())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Look Back</span>
            <h2 class="text-3xl font-extrabold text-gray-900 mt-1">Past Events</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @php $pastGrads = ['from-gray-500 to-gray-700','from-gray-600 to-gray-800']; @endphp
            @foreach($past as $p)
            <a href="{{ route('events.show', $p->slug) }}"
               class="flex items-center gap-4 bg-gray-50 rounded-xl p-4 border border-gray-100 hover:border-primary-200 hover:bg-primary-50/30 transition-all group">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br {{ $pastGrads[$loop->index % 2] }} flex items-center justify-center flex-shrink-0 text-2xl">
                    📅
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-700 text-sm truncate group-hover:text-primary-700 transition-colors">{{ $p->title }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $p->start_date->format('M d, Y') }} · {{ $p->venue ?? 'Online' }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $p->registrations_count ?? 0 }} attendees</p>
                </div>
                <span class="text-xs bg-gray-200 text-gray-500 px-2 py-1 rounded-full font-medium flex-shrink-0">{{ ucfirst($p->event_type) }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Why Attend --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-xs font-bold text-primary-600 uppercase tracking-widest">The Value</span>
            <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Why Attend VentureMatch Events?</h2>
        </div>
        @php
            $reasons = [
                ['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','title'=>'Curated Networking','desc'=>'Every attendee is vetted — no noise, just serious investors, founders, and ecosystem builders.','color'=>'bg-blue-50 text-blue-600'],
                ['icon'=>'M13 10V3L4 14h7v7l9-11h-7z','title'=>'Live Deal Flow','desc'=>'Startups pitch live, investors engage in real time — deals happen at our events, not just online.','color'=>'bg-amber-50 text-amber-600'],
                ['icon'=>'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z','title'=>'Expert Insights','desc'=>'Keynotes and panels from leading investors, operators, and policymakers shaping the ecosystem.','color'=>'bg-purple-50 text-purple-600'],
                ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','title'=>'Verified Community','desc'=>'All participants are registered VentureMatch members — a trusted, high-quality community.','color'=>'bg-green-50 text-green-600'],
            ];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($reasons as $r)
            <div class="bg-white rounded-2xl p-7 border border-gray-100 hover:shadow-md transition-shadow text-center">
                <div class="w-14 h-14 {{ $r['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $r['icon'] }}"/>
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 mb-2">{{ $r['title'] }}</h4>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $r['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 right-20 w-64 h-64 bg-accent-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 left-10 w-80 h-80 bg-white rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-extrabold mb-4">Never Miss an Event</h2>
        <p class="text-primary-200 text-lg mb-8 max-w-xl mx-auto">Subscribe to get early access, speaker announcements, and exclusive member discounts for every VentureMatch event.</p>
        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-3 justify-center max-w-md mx-auto">
            @csrf
            <input type="email" name="email" placeholder="your@email.com" required
                   class="flex-1 bg-white/10 border border-white/30 text-white placeholder-white/50 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white backdrop-blur-sm">
            <button type="submit" class="bg-accent-500 hover:bg-accent-600 text-white font-semibold px-6 py-3 rounded-xl transition-colors text-sm flex-shrink-0">
                Notify Me
            </button>
        </form>
    </div>
</section>

@endsection
