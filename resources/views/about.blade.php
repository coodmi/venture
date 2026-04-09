@extends('layouts.app')
@section('title', 'About VentureMatch')
@section('meta_description', 'Learn about VentureMatch — the platform connecting investors with high-potential startups and ecosystem opportunities.')

@section('content')

{{-- Hero --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-20 w-80 h-80 bg-accent-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 lg:py-36">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-primary-200 text-xs font-semibold px-4 py-1.5 rounded-full mb-6 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 bg-accent-400 rounded-full"></span>
                Our Story
            </span>
            <h1 class="text-5xl sm:text-6xl font-extrabold leading-tight mb-6 tracking-tight">
                Building the Bridge<br>
                <span class="text-accent-400">Between Capital &amp;</span><br>
                <span class="text-white/80">Innovation</span>
            </h1>
            <p class="text-lg text-primary-200 leading-relaxed max-w-xl">
                VentureMatch was founded with a single belief — that the right connection between an investor and a founder can change the world.
            </p>
        </div>
    </div>
    {{-- Wave divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 60L1440 60L1440 20C1200 60 960 0 720 20C480 40 240 0 0 20L0 60Z" fill="white"/>
        </svg>
    </div>
</section>

{{-- Overview / Who We Are --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-xs font-bold text-primary-600 uppercase tracking-widest">Who We Are</span>
                <h2 class="text-4xl font-extrabold text-gray-900 mt-3 mb-6 leading-tight">
                    {{ $sections['overview']->title ?? 'The Investment Ecosystem Platform' }}
                </h2>
                <div class="text-gray-600 leading-relaxed space-y-4 text-base">
                    @if(isset($sections['overview']))
                        {!! $sections['overview']->content !!}
                    @else
                        <p>VentureMatch is a curated investment ecosystem platform that connects investors, founders, startups, and ecosystem partners on a single, powerful platform.</p>
                        <p>We believe that capital should flow to the best ideas — regardless of geography, network, or background. Our platform removes friction from the deal discovery process and creates meaningful connections that drive real growth.</p>
                        <p>From angel investors to venture capital firms, from early-stage startups to growth-stage companies — VentureMatch serves the entire investment lifecycle.</p>
                    @endif
                </div>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('register.investor') }}" class="bg-primary-600 text-white font-semibold px-6 py-3 rounded-xl hover:bg-primary-700 transition-colors text-sm">
                        Join as Investor
                    </a>
                    <a href="{{ route('register.seeker') }}" class="border border-primary-600 text-primary-600 font-semibold px-6 py-3 rounded-xl hover:bg-primary-50 transition-colors text-sm">
                        Join as Seeker
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="grid grid-cols-2 gap-4">
                    @php
                        $highlights = [
                            ['value' => '500+', 'label' => 'Registered Investors', 'color' => 'bg-primary-50 border-primary-100'],
                            ['value' => '200+', 'label' => 'Startups Listed',      'color' => 'bg-accent-50 border-amber-100'],
                            ['value' => '$50M+','label' => 'Capital Connected',    'color' => 'bg-green-50 border-green-100'],
                            ['value' => '15+',  'label' => 'Countries Reached',    'color' => 'bg-purple-50 border-purple-100'],
                        ];
                    @endphp
                    @foreach($highlights as $h)
                    <div class="border {{ $h['color'] }} rounded-2xl p-6 text-center">
                        <p class="text-3xl font-extrabold text-gray-900">{{ $h['value'] }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $h['label'] }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-primary-600 rounded-2xl opacity-10"></div>
                <div class="absolute -top-4 -left-4 w-16 h-16 bg-accent-500 rounded-xl opacity-10"></div>
            </div>
        </div>
    </div>
</section>

{{-- Vision & Mission --}}
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-primary-600 uppercase tracking-widest">What Drives Us</span>
            <h2 class="text-4xl font-extrabold text-gray-900 mt-3">Vision &amp; Mission</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="relative bg-white rounded-3xl p-10 border border-gray-100 shadow-sm overflow-hidden group hover:shadow-lg transition-shadow">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-50 rounded-bl-full opacity-60"></div>
                <div class="relative">
                    <div class="w-14 h-14 bg-primary-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                        {{ $sections['vision']->title ?? 'Our Vision' }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed text-base">
                        {{ $sections['vision']->content ?? 'To become the most trusted investment ecosystem platform in emerging markets — where every great idea finds the capital it deserves, and every investor discovers their next breakthrough opportunity.' }}
                    </p>
                </div>
            </div>
            <div class="relative bg-primary-950 rounded-3xl p-10 overflow-hidden group hover:shadow-lg transition-shadow">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-800 rounded-bl-full opacity-60"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-accent-500/10 rounded-tr-full"></div>
                <div class="relative">
                    <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">
                        {{ $sections['mission']->title ?? 'Our Mission' }}
                    </h3>
                    <p class="text-primary-200 leading-relaxed text-base">
                        {{ $sections['mission']->content ?? 'To democratize access to investment opportunities by building a transparent, efficient, and inclusive platform that empowers investors and founders to connect, collaborate, and grow together.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Core Values --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-primary-600 uppercase tracking-widest">What We Stand For</span>
            <h2 class="text-4xl font-extrabold text-gray-900 mt-3">Our Core Values</h2>
        </div>
        @php
            $values = [
                ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Trust & Transparency', 'desc' => 'Every interaction on VentureMatch is built on verified data, honest communication, and mutual respect between all parties.', 'color' => 'text-blue-600 bg-blue-50'],
                ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Inclusive Access', 'desc' => 'We break down barriers so that geography, background, or network size never limits a founder\'s ability to raise capital.', 'color' => 'text-green-600 bg-green-50'],
                ['icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'title' => 'Innovation First', 'desc' => 'We continuously evolve our platform to stay ahead of market needs, embracing new technologies and approaches.', 'color' => 'text-amber-600 bg-amber-50'],
                ['icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'title' => 'Impact Driven', 'desc' => 'We measure success not just in deals closed, but in businesses built, jobs created, and communities transformed.', 'color' => 'text-purple-600 bg-purple-50'],
                ['icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z', 'title' => 'Security & Privacy', 'desc' => 'Sensitive business information is protected with enterprise-grade security and strict data privacy standards.', 'color' => 'text-red-600 bg-red-50'],
                ['icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9', 'title' => 'Global Mindset', 'desc' => 'We connect capital and opportunity across borders, building a truly global investment ecosystem.', 'color' => 'text-teal-600 bg-teal-50'],
            ];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($values as $v)
            <div class="group p-8 rounded-2xl border border-gray-100 hover:border-primary-200 hover:shadow-md transition-all bg-white">
                <div class="w-12 h-12 {{ $v['color'] }} rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $v['icon'] }}"/>
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $v['title'] }}</h4>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $v['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- How It Works --}}
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-primary-600 uppercase tracking-widest">The Process</span>
            <h2 class="text-4xl font-extrabold text-gray-900 mt-3">How VentureMatch Works</h2>
            <p class="text-gray-500 mt-4 max-w-xl mx-auto">A streamlined process designed to get the right capital to the right opportunity — fast.</p>
        </div>
        @php
            $steps = [
                ['num' => '01', 'title' => 'Register & Build Profile', 'desc' => 'Investors and seekers create verified profiles that showcase their credentials, preferences, and goals.', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ['num' => '02', 'title' => 'Discover Opportunities', 'desc' => 'Investors browse curated, admin-verified opportunities filtered by sector, stage, ticket size, and geography.', 'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
                ['num' => '03', 'title' => 'Express Interest', 'desc' => 'Investors save, shortlist, or request meetings directly through the platform — no cold emails needed.', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                ['num' => '04', 'title' => 'Connect & Close', 'desc' => 'Both parties engage, negotiate, and close deals with full visibility into interest levels and next steps.', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ];
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative">
            {{-- Connector line --}}
            <div class="hidden lg:block absolute top-10 left-[12.5%] right-[12.5%] h-0.5 bg-gradient-to-r from-primary-200 via-primary-400 to-primary-200 z-0"></div>
            @foreach($steps as $step)
            <div class="relative z-10 text-center">
                <div class="w-20 h-20 bg-white border-2 border-primary-200 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-sm group-hover:border-primary-500 transition-colors">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-primary-400 tracking-widest">STEP {{ $step['num'] }}</span>
                <h4 class="text-base font-bold text-gray-900 mt-1 mb-2">{{ $step['title'] }}</h4>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Founder's Message --}}
<section class="py-24 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 items-center">
            <div class="lg:col-span-2 flex flex-col items-center lg:items-start">
                @if(isset($sections['founder_message']) && $sections['founder_message']->image)
                    <img src="{{ Storage::url($sections['founder_message']->image) }}" alt="Founder" class="w-48 h-48 rounded-3xl object-cover shadow-xl">
                @else
                    <div class="w-48 h-48 bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl flex items-center justify-center shadow-xl">
                        <span class="text-white font-extrabold text-6xl">F</span>
                    </div>
                @endif
                <div class="mt-6 text-center lg:text-left">
                    <p class="font-bold text-gray-900 text-lg">
                        {{ $sections['founder_message']->title ?? 'Founder & CEO' }}
                    </p>
                    <p class="text-primary-600 text-sm font-medium mt-0.5">VentureMatch</p>
                    <div class="flex gap-3 mt-4 justify-center lg:justify-start">
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-primary-100 transition-colors">
                            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-3">
                <span class="text-xs font-bold text-primary-600 uppercase tracking-widest">A Message From Our Founder</span>
                <h2 class="text-3xl font-extrabold text-gray-900 mt-3 mb-6">Why We Built VentureMatch</h2>
                <div class="relative">
                    <svg class="absolute -top-4 -left-4 w-10 h-10 text-primary-100" fill="currentColor" viewBox="0 0 32 32">
                        <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/>
                    </svg>
                    <p class="text-gray-600 leading-relaxed text-base pl-6 italic">
                        {{ $sections['founder_message']->content ?? 'I\'ve seen firsthand how difficult it is for brilliant founders to get in front of the right investors — and how hard it is for investors to find truly vetted, high-quality opportunities. VentureMatch was born to solve exactly that. We\'re not just a platform; we\'re a community committed to making the investment ecosystem more accessible, transparent, and impactful for everyone involved.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Timeline --}}
<section class="py-24 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-primary-600 uppercase tracking-widest">Our Journey</span>
            <h2 class="text-4xl font-extrabold text-gray-900 mt-3">Milestones &amp; Growth</h2>
        </div>
        @php
            $milestones = isset($sections['timeline']) && $sections['timeline']->extra
                ? $sections['timeline']->extra
                : [
                    ['year' => '2022', 'title' => 'Platform Founded',         'description' => 'VentureMatch was incorporated with a vision to democratize investment access in emerging markets.'],
                    ['year' => '2023', 'title' => 'First 100 Investors',      'description' => 'Reached 100 registered investors and launched the first cohort of curated startup opportunities.'],
                    ['year' => '2023', 'title' => 'Membership Program Launch','description' => 'Introduced tiered membership plans for investors, partners, and ecosystem stakeholders.'],
                    ['year' => '2024', 'title' => '$10M Capital Connected',   'description' => 'Facilitated over $10M in investor-startup connections through the platform.'],
                    ['year' => '2025', 'title' => 'Regional Expansion',       'description' => 'Expanded operations to 10+ countries with dedicated regional investment tracks.'],
                    ['year' => '2026', 'title' => 'Platform 2.0',             'description' => 'Launched the redesigned platform with advanced matching, analytics, and ecosystem tools.'],
                ];
        @endphp
        <div class="relative">
            <div class="absolute left-1/2 top-0 bottom-0 w-0.5 bg-gradient-to-b from-primary-300 via-primary-500 to-primary-300 transform -translate-x-1/2 hidden md:block"></div>
            <div class="space-y-10">
                @foreach($milestones as $i => $m)
                <div class="relative flex flex-col md:flex-row items-start md:items-center gap-6 {{ $i % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse' }}">
                    {{-- Content --}}
                    <div class="flex-1 {{ $i % 2 === 0 ? 'md:text-right' : 'md:text-left' }}">
                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow inline-block w-full">
                            <span class="text-xs font-bold text-primary-600 bg-primary-50 px-3 py-1 rounded-full">{{ $m['year'] ?? '' }}</span>
                            <h4 class="font-bold text-gray-900 mt-3 mb-1">{{ $m['title'] ?? '' }}</h4>
                            <p class="text-sm text-gray-500 leading-relaxed">{{ $m['description'] ?? '' }}</p>
                        </div>
                    </div>
                    {{-- Center dot --}}
                    <div class="hidden md:flex w-5 h-5 bg-primary-600 rounded-full border-4 border-white shadow-md flex-shrink-0 z-10"></div>
                    {{-- Spacer --}}
                    <div class="flex-1 hidden md:block"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-24 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 right-20 w-64 h-64 bg-accent-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 left-10 w-80 h-80 bg-white rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 text-center">
        <span class="inline-block bg-white/10 border border-white/20 text-primary-200 text-xs font-semibold px-4 py-1.5 rounded-full mb-6">
            Ready to Get Started?
        </span>
        <h2 class="text-4xl sm:text-5xl font-extrabold mb-6 leading-tight">
            Join the VentureMatch<br>
            <span class="text-accent-400">Ecosystem Today</span>
        </h2>
        <p class="text-primary-200 text-lg mb-10 max-w-xl mx-auto leading-relaxed">
            Whether you're an investor looking for your next portfolio company or a founder seeking the capital to scale — your journey starts here.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('register.investor') }}"
               class="bg-accent-500 hover:bg-accent-600 text-white font-semibold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all text-sm">
                Join as Investor →
            </a>
            <a href="{{ route('register.seeker') }}"
               class="bg-white/10 hover:bg-white/20 border border-white/30 text-white font-semibold px-8 py-4 rounded-xl backdrop-blur-sm transition-all text-sm">
                Join as Seeker →
            </a>
        </div>
    </div>
</section>

@endsection
