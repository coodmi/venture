@extends('layouts.app')

@section('title', 'VentureMatch — Connect. Invest. Grow.')
@section('meta_description', 'VentureMatch connects investors with high-potential startups, projects, and ecosystem opportunities.')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-accent-500 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="max-w-3xl">
            <span class="inline-block bg-primary-700/50 text-primary-200 text-xs font-semibold px-3 py-1 rounded-full mb-6 border border-primary-600">
                🚀 The Investment Ecosystem Platform
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                Where Investors Meet<br>
                <span class="text-accent-500">Tomorrow's Ventures</span>
            </h1>
            <p class="text-lg text-primary-200 mb-10 max-w-2xl leading-relaxed">
                VentureMatch brings together investors, founders, startups, partners, and ecosystem stakeholders on one powerful platform — making deal discovery, collaboration, and growth seamless.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('register.investor') }}"
                   class="bg-accent-500 hover:bg-accent-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                    Join as Investor
                </a>
                <a href="{{ route('register.seeker') }}"
                   class="bg-white/10 hover:bg-white/20 border border-white/30 text-white font-semibold px-6 py-3 rounded-xl backdrop-blur-sm transition-all">
                    Join as Seeker
                </a>
                <a href="{{ route('investor.opportunities.index') }}"
                   class="border border-white/30 text-white font-semibold px-6 py-3 rounded-xl hover:bg-white/10 transition-all">
                    Explore Opportunities →
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Stats Section --}}
@if($stats->count())
<section class="bg-white border-b border-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 text-center">
            @foreach($stats as $stat)
            <div>
                <div class="text-3xl font-extrabold text-primary-700" data-counter="{{ $stat->value }}">{{ $stat->value }}</div>
                <div class="text-sm text-gray-500 mt-1">{{ $stat->label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Platform Overview --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold text-gray-900">How VentureMatch Works</h2>
            <p class="text-gray-500 mt-3 max-w-xl mx-auto">A connected ecosystem where every stakeholder finds value.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $steps = [
                    ['icon' => '🔍', 'title' => 'Discover', 'desc' => 'Investors browse curated opportunities filtered by sector, stage, and ticket size.'],
                    ['icon' => '🤝', 'title' => 'Connect', 'desc' => 'Express interest, request meetings, and engage directly with founders.'],
                    ['icon' => '🚀', 'title' => 'Grow', 'desc' => 'Close deals, join bootcamps, attend conferences, and scale together.'],
                ];
            @endphp
            @foreach($steps as $i => $step)
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
                <div class="text-4xl mb-4">{{ $step['icon'] }}</div>
                <div class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center text-sm font-bold mx-auto mb-4">{{ $i + 1 }}</div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $step['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Hot Deals --}}
@if($hotDeals->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-xs font-semibold text-red-500 uppercase tracking-wider">🔥 Limited Time</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-1">Hot Deals</h2>
            </div>
            <a href="{{ route('investor.opportunities.index') }}" class="text-primary-600 text-sm font-medium hover:underline">View all →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($hotDeals as $deal)
            <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-shadow group">
                <div class="flex items-center justify-between mb-3">
                    <span class="bg-red-50 text-red-600 text-xs font-semibold px-2 py-1 rounded-full">🔥 Hot Deal</span>
                    <span class="text-xs text-gray-400">{{ $deal->sector }}</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors">{{ $deal->title }}</h3>
                <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $deal->solution }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-primary-700 font-bold text-sm">${{ number_format($deal->ask_amount) }} {{ $deal->ask_currency }}</span>
                    <a href="{{ route('investor.opportunities.show', $deal->slug) }}" class="text-xs text-primary-600 font-medium hover:underline">View Details →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Featured Opportunities --}}
@if($featured->count())
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-xs font-semibold text-primary-600 uppercase tracking-wider">⭐ Curated</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-1">Featured Opportunities</h2>
            </div>
            <a href="{{ route('investor.opportunities.index') }}" class="text-primary-600 text-sm font-medium hover:underline">View all →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featured as $opp)
            <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-shadow group">
                <div class="flex items-center justify-between mb-3">
                    <span class="bg-primary-50 text-primary-700 text-xs font-semibold px-2 py-1 rounded-full">{{ $opp->stage }}</span>
                    <span class="text-xs text-gray-400">{{ $opp->sector }}</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors">{{ $opp->title }}</h3>
                <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $opp->solution }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-primary-700 font-bold text-sm">${{ number_format($opp->ask_amount) }}</span>
                    <a href="{{ route('investor.opportunities.show', $opp->slug) }}" class="text-xs text-primary-600 font-medium hover:underline">View Details →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Upcoming Events --}}
@if($events->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-xs font-semibold text-green-600 uppercase tracking-wider">📅 Upcoming</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-1">Events & Conferences</h2>
            </div>
            <a href="{{ route('events.index') }}" class="text-primary-600 text-sm font-medium hover:underline">View all →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($events as $event)
            <a href="{{ route('events.show', $event->slug) }}" class="group block bg-gray-50 rounded-2xl overflow-hidden hover:shadow-md transition-shadow">
                @if($event->banner)
                    <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}" class="w-full h-36 object-cover">
                @else
                    <div class="w-full h-36 bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center">
                        <span class="text-white text-3xl">📅</span>
                    </div>
                @endif
                <div class="p-4">
                    <span class="text-xs text-primary-600 font-medium">{{ $event->start_date->format('M d, Y') }}</span>
                    <h3 class="font-semibold text-gray-900 mt-1 text-sm group-hover:text-primary-600 transition-colors line-clamp-2">{{ $event->title }}</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $event->venue ?? 'Online' }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Testimonials --}}
@if($testimonials->count())
<section class="py-20 bg-primary-950 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold">What Our Members Say</h2>
            <p class="text-primary-300 mt-3">Real stories from investors, founders, and partners.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $t)
            <div class="bg-primary-900/50 border border-primary-800 rounded-2xl p-6">
                <div class="flex gap-1 mb-4">
                    @for($i = 0; $i < $t->rating; $i++)
                        <span class="text-accent-500 text-sm">★</span>
                    @endfor
                </div>
                <p class="text-primary-200 text-sm leading-relaxed mb-6">"{{ $t->content }}"</p>
                <div class="flex items-center gap-3">
                    @if($t->photo)
                        <img src="{{ Storage::url($t->photo) }}" alt="{{ $t->name }}" class="w-10 h-10 rounded-full object-cover">
                    @else
                        <div class="w-10 h-10 bg-primary-700 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">{{ substr($t->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div>
                        <p class="font-semibold text-white text-sm">{{ $t->name }}</p>
                        <p class="text-primary-400 text-xs">{{ $t->designation }}{{ $t->organization ? ', ' . $t->organization : '' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Latest News --}}
@if($latestNews->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-3xl font-bold text-gray-900">Latest News</h2>
            <a href="{{ route('news.index') }}" class="text-primary-600 text-sm font-medium hover:underline">View all →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($latestNews as $article)
            <a href="{{ route('news.show', $article->slug) }}" class="group block">
                @if($article->cover_image)
                    <img src="{{ Storage::url($article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover rounded-xl mb-4">
                @else
                    <div class="w-full h-48 bg-gray-100 rounded-xl mb-4 flex items-center justify-center">
                        <span class="text-4xl">📰</span>
                    </div>
                @endif
                <span class="text-xs text-primary-600 font-medium">{{ $article->category }}</span>
                <h3 class="font-semibold text-gray-900 mt-1 group-hover:text-primary-600 transition-colors line-clamp-2">{{ $article->title }}</h3>
                <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $article->summary }}</p>
                <p class="text-xs text-gray-400 mt-2">{{ $article->published_at?->format('M d, Y') }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA Section --}}
<section class="py-20 bg-gradient-to-r from-primary-600 to-primary-800 text-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Join the Ecosystem?</h2>
        <p class="text-primary-200 mb-8 text-lg">Whether you're an investor looking for the next big opportunity or a founder seeking capital — VentureMatch is your platform.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('register.investor') }}" class="bg-white text-primary-700 font-semibold px-8 py-3 rounded-xl hover:bg-gray-100 transition-colors">
                Join as Investor
            </a>
            <a href="{{ route('register.seeker') }}" class="border-2 border-white text-white font-semibold px-8 py-3 rounded-xl hover:bg-white/10 transition-colors">
                Join as Seeker
            </a>
        </div>
    </div>
</section>

@endsection
