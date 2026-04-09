@extends('layouts.app')
@section('title', $event->title . ' — VentureMatch Events')
@section('meta_description', $event->summary ?? 'Join us at ' . $event->title)

@section('content')

{{-- Hero Banner --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white overflow-hidden">
    @if($event->banner)
        <div class="absolute inset-0">
            <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-950/90 to-primary-800/80"></div>
        </div>
    @else
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-20 w-80 h-80 bg-accent-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>
    @endif
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
        <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 text-primary-300 hover:text-white text-sm mb-8 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Events
        </a>
        <div class="flex flex-wrap gap-2 mb-5">
            <span class="bg-white/15 border border-white/25 text-white text-xs font-semibold px-3 py-1.5 rounded-full backdrop-blur-sm">
                {{ ucfirst($event->event_type) }}
            </span>
            @if($event->category)
            <span class="bg-accent-500/80 text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                {{ $event->category }}
            </span>
            @endif
            @if($event->is_featured)
            <span class="bg-amber-400/90 text-amber-900 text-xs font-bold px-3 py-1.5 rounded-full">
                ⭐ Featured Event
            </span>
            @endif
        </div>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 max-w-4xl tracking-tight">
            {{ $event->title }}
        </h1>
        @if($event->summary)
        <p class="text-lg text-primary-200 max-w-2xl leading-relaxed mb-8">{{ $event->summary }}</p>
        @endif
        <div class="flex flex-wrap gap-6 text-sm text-primary-200">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span class="font-medium text-white">{{ $event->start_date->format('l, F j, Y') }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ $event->start_date->format('g:i A') }}{{ $event->end_date ? ' – ' . $event->end_date->format('g:i A') : '' }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ $event->venue ?? 'Online Event' }}</span>
            </div>
            @if($event->max_attendees)
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ $event->max_attendees }} seats max</span>
            </div>
            @endif
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 50" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 50L1440 50L1440 15C1200 50 960 0 720 15C480 30 240 0 0 15L0 50Z" fill="white"/>
        </svg>
    </div>
</section>

{{-- Main Content --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- Left: Details --}}
            <div class="lg:col-span-2 space-y-10">

                {{-- About --}}
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-4">About This Event</h2>
                    @if($event->description)
                        <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed">{!! $event->description !!}</div>
                    @else
                        <div class="space-y-4 text-gray-600 leading-relaxed">
                            <p>Join us for <strong>{{ $event->title }}</strong> — one of VentureMatch's flagship events bringing together the most active investors, high-potential founders, and ecosystem enablers under one roof.</p>
                            <p>This event is designed to create meaningful connections, surface quality deal flow, and provide actionable insights from industry leaders who are actively deploying capital and building companies.</p>
                            <p>Whether you're an investor looking for your next portfolio company, a founder seeking capital and mentorship, or an ecosystem partner looking to engage — this event is built for you.</p>
                        </div>
                    @endif
                </div>

                {{-- What to Expect --}}
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-6">What to Expect</h2>
                    @php
                        $highlights = [
                            ['icon'=>'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z','title'=>'Keynote Speakers','desc'=>'Hear from leading investors and operators sharing real insights on deal-making and market trends.','color'=>'bg-blue-50 text-blue-600'],
                            ['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','title'=>'Curated Networking','desc'=>'Structured networking sessions with pre-matched investor-founder meetings and open networking.','color'=>'bg-green-50 text-green-600'],
                            ['icon'=>'M13 10V3L4 14h7v7l9-11h-7z','title'=>'Live Pitches','desc'=>'Watch vetted startups pitch live to a panel of investors — and see deals happen in real time.','color'=>'bg-amber-50 text-amber-600'],
                            ['icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z','title'=>'Verified Attendees','desc'=>'Every attendee is a registered VentureMatch member — no noise, just serious participants.','color'=>'bg-purple-50 text-purple-600'],
                        ];
                    @endphp
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($highlights as $h)
                        <div class="flex gap-4 p-5 bg-gray-50 rounded-2xl border border-gray-100 hover:border-primary-200 transition-colors">
                            <div class="w-11 h-11 {{ $h['color'] }} rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $h['icon'] }}"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm mb-1">{{ $h['title'] }}</h4>
                                <p class="text-xs text-gray-500 leading-relaxed">{{ $h['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Agenda --}}
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Event Agenda</h2>
                    @php
                        $agendaItems = $event->agenda ?? [
                            ['time'=>'8:30 AM','title'=>'Registration & Welcome Coffee','type'=>'break'],
                            ['time'=>'9:00 AM','title'=>'Opening Keynote: The State of Investment in Emerging Markets','type'=>'keynote'],
                            ['time'=>'9:45 AM','title'=>'Panel: What Investors Look for in 2026','type'=>'panel'],
                            ['time'=>'10:45 AM','title'=>'Networking Break','type'=>'break'],
                            ['time'=>'11:00 AM','title'=>'Startup Pitch Session I — FinTech & HealthTech','type'=>'pitch'],
                            ['time'=>'12:00 PM','title'=>'Lunch & Curated Networking','type'=>'break'],
                            ['time'=>'1:30 PM','title'=>'Startup Pitch Session II — AgriTech & CleanTech','type'=>'pitch'],
                            ['time'=>'2:30 PM','title'=>'Workshop: Due Diligence Essentials','type'=>'workshop'],
                            ['time'=>'3:30 PM','title'=>'Afternoon Break','type'=>'break'],
                            ['time'=>'4:00 PM','title'=>'Fireside Chat: From Seed to Series B','type'=>'keynote'],
                            ['time'=>'5:00 PM','title'=>'Closing Remarks & Awards','type'=>'keynote'],
                            ['time'=>'5:30 PM','title'=>'Evening Networking Reception','type'=>'break'],
                        ];
                        $typeColors = ['keynote'=>'bg-primary-100 text-primary-700','panel'=>'bg-blue-100 text-blue-700','pitch'=>'bg-amber-100 text-amber-700','workshop'=>'bg-green-100 text-green-700','break'=>'bg-gray-100 text-gray-500'];
                    @endphp
                    <div class="space-y-2">
                        @foreach($agendaItems as $item)
                        @php
                            $t = is_array($item) ? ($item['type'] ?? 'break') : 'break';
                            $color = $typeColors[$t] ?? 'bg-gray-100 text-gray-500';
                        @endphp
                        <div class="flex items-center gap-4 p-4 rounded-xl {{ $t === 'break' ? 'bg-gray-50' : 'bg-white border border-gray-100 shadow-sm' }} hover:border-primary-100 transition-colors">
                            <div class="w-20 text-xs font-bold text-gray-500 flex-shrink-0">
                                {{ is_array($item) ? $item['time'] : '' }}
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-800">{{ is_array($item) ? $item['title'] : $item }}</p>
                            </div>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $color }} flex-shrink-0 capitalize">
                                {{ $t }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Speakers --}}
                @php
                    $speakers = $event->speakers ?? [
                        ['name'=>'Arif Rahman','role'=>'Managing Partner, Dhaka Ventures','bio'=>'15+ years in venture capital with $200M+ deployed across Southeast Asia.'],
                        ['name'=>'Nadia Islam','role'=>'Founder & CEO, HealthBridge','bio'=>'Serial entrepreneur, 2x exit, Forbes 30 Under 30 Asia 2024.'],
                        ['name'=>'Karim Chowdhury','role'=>'Director, Bangladesh Investment Authority','bio'=>'Policy expert driving FDI and startup ecosystem development.'],
                        ['name'=>'Priya Sharma','role'=>'Partner, Tiger Global (South Asia)','bio'=>'Leads early-stage investments in FinTech and SaaS across South Asia.'],
                    ];
                @endphp
                @if(!empty($speakers))
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Speakers</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($speakers as $speaker)
                        <div class="flex items-center gap-4 p-5 bg-gray-50 rounded-2xl border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-extrabold text-xl">
                                    {{ strtoupper(substr(is_array($speaker) ? $speaker['name'] : $speaker, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">{{ is_array($speaker) ? $speaker['name'] : $speaker }}</p>
                                @if(is_array($speaker) && isset($speaker['role']))
                                <p class="text-xs text-primary-600 font-medium mt-0.5">{{ $speaker['role'] }}</p>
                                @endif
                                @if(is_array($speaker) && isset($speaker['bio']))
                                <p class="text-xs text-gray-500 mt-1 leading-relaxed">{{ $speaker['bio'] }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            {{-- Right: Sidebar --}}
            <div class="space-y-5">

                {{-- Registration Card --}}
                <div class="bg-white rounded-2xl border-2 {{ $event->registration_open ? 'border-primary-500' : 'border-gray-200' }} shadow-lg overflow-hidden sticky top-24">
                    @if($event->registration_open)
                    <div class="bg-primary-600 px-5 py-3 flex items-center justify-between">
                        <span class="text-white font-bold text-sm">Registration Open</span>
                        <span class="flex items-center gap-1.5 text-green-300 text-xs font-semibold">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span> Live
                        </span>
                    </div>
                    @else
                    <div class="bg-gray-500 px-5 py-3">
                        <span class="text-white font-bold text-sm">Registration Closed</span>
                    </div>
                    @endif

                    <div class="p-5">
                        {{-- Event Quick Info --}}
                        <div class="space-y-3 mb-5 pb-5 border-b border-gray-100">
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <div>
                                    <p class="text-xs text-gray-400">Date</p>
                                    <p class="text-sm font-semibold text-gray-800">{{ $event->start_date->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <div>
                                    <p class="text-xs text-gray-400">Time</p>
                                    <p class="text-sm font-semibold text-gray-800">{{ $event->start_date->format('g:i A') }}{{ $event->end_date ? ' – '.$event->end_date->format('g:i A') : '' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <div>
                                    <p class="text-xs text-gray-400">Venue</p>
                                    <p class="text-sm font-semibold text-gray-800">{{ $event->venue ?? 'Online Event' }}</p>
                                    @if($event->online_link && $event->event_type !== 'offline')
                                    <a href="{{ $event->online_link }}" target="_blank" class="text-xs text-primary-600 hover:underline">Join Online →</a>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                <div>
                                    <p class="text-xs text-gray-400">Type</p>
                                    <p class="text-sm font-semibold text-gray-800">{{ ucfirst($event->event_type) }}{{ $event->category ? ' · '.$event->category : '' }}</p>
                                </div>
                            </div>
                            @if($event->max_attendees)
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <div>
                                    <p class="text-xs text-gray-400">Capacity</p>
                                    <p class="text-sm font-semibold text-gray-800">{{ $event->max_attendees }} seats</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Registration Form --}}
                        @if($event->registration_open)
                            @if(session('success'))
                            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ session('success') }}
                            </div>
                            @endif
                            @if($errors->any())
                            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4">
                                {{ $errors->first() }}
                            </div>
                            @endif
                            <form method="POST" action="{{ route('events.register', $event) }}" class="space-y-3">
                                @csrf
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Full Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" required value="{{ old('name', auth()->user()?->name) }}"
                                           class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" required value="{{ old('email', auth()->user()?->email) }}"
                                           class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Phone</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}"
                                           class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Organization</label>
                                    <input type="text" name="organization" value="{{ old('organization') }}"
                                           class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Designation</label>
                                    <input type="text" name="designation" value="{{ old('designation') }}"
                                           class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                </div>
                                <button type="submit"
                                        class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 rounded-xl transition-colors text-sm shadow-md hover:shadow-lg">
                                    Register Now — Free
                                </button>
                                <p class="text-xs text-gray-400 text-center">You'll receive a confirmation email after registration.</p>
                            </form>
                        @else
                            <div class="text-center py-4">
                                <p class="text-sm text-gray-500 mb-3">Registration for this event is currently closed.</p>
                                <a href="{{ route('events.index') }}" class="text-primary-600 text-sm font-semibold hover:underline">Browse other events →</a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Share --}}
                <div class="bg-gray-50 rounded-2xl border border-gray-200 p-5">
                    <h4 class="font-bold text-gray-900 text-sm mb-3">Share This Event</h4>
                    <div class="flex gap-2">
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank"
                           class="flex-1 flex items-center justify-center gap-2 bg-blue-600 text-white text-xs font-semibold py-2.5 rounded-xl hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            LinkedIn
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($event->title) }}&url={{ urlencode(url()->current()) }}" target="_blank"
                           class="flex-1 flex items-center justify-center gap-2 bg-sky-500 text-white text-xs font-semibold py-2.5 rounded-xl hover:bg-sky-600 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            Twitter
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- More Events --}}
<section class="py-16 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-extrabold text-gray-900">More Events</h2>
            <a href="{{ route('events.index') }}" class="text-primary-600 text-sm font-semibold hover:underline">View all →</a>
        </div>
        @php
            $gradients = ['from-blue-600 to-indigo-700','from-purple-600 to-pink-600','from-green-600 to-teal-600','from-orange-500 to-red-600','from-primary-600 to-primary-800','from-amber-500 to-orange-600'];
            $icons     = ['💡','🤝','📊','🌍','🏆','🚀'];
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @forelse($moreEvents as $more)
            <a href="{{ route('events.show', $more->slug) }}"
               class="group bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-md hover:-translate-y-0.5 transition-all">
                @if($more->banner)
                    <img src="{{ Storage::url($more->banner) }}" alt="{{ $more->title }}" class="w-full h-32 object-cover">
                @else
                    <div class="h-32 bg-gradient-to-br {{ $gradients[$loop->index % count($gradients)] }} flex items-center justify-center">
                        <span class="text-4xl">{{ $icons[$loop->index % count($icons)] }}</span>
                    </div>
                @endif
                <div class="p-4">
                    <h4 class="font-bold text-gray-900 text-sm group-hover:text-primary-600 transition-colors mb-2">{{ $more->title }}</h4>
                    <p class="text-xs text-gray-500 flex items-center gap-1.5 mb-1">
                        <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $more->start_date->format('M d, Y') }}
                    </p>
                    <p class="text-xs text-gray-500 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $more->venue ?? 'Online' }}
                    </p>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-8 text-gray-400 text-sm">No other upcoming events right now.</div>
            @endforelse
        </div>
    </div>
</section>

@endsection
