@php
// Demo view — same layout as show.blade.php but with no real DB event
// Registration form posts to a dummy route that just redirects back with success
@endphp
@extends('layouts.app')
@section('title', $event->title . ' — VentureMatch Events')
@section('meta_description', $event->summary)

@section('content')

{{-- Hero Banner --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-20 w-80 h-80 bg-accent-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
        <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 text-primary-300 hover:text-white text-sm mb-8 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Events
        </a>
        <div class="flex flex-wrap gap-2 mb-5">
            <span class="bg-white/15 border border-white/25 text-white text-xs font-semibold px-3 py-1.5 rounded-full backdrop-blur-sm">{{ ucfirst($event->event_type) }}</span>
            @if($event->category)
            <span class="bg-accent-500/80 text-white text-xs font-semibold px-3 py-1.5 rounded-full">{{ $event->category }}</span>
            @endif
            @if($event->is_featured)
            <span class="bg-amber-400/90 text-amber-900 text-xs font-bold px-3 py-1.5 rounded-full">⭐ Featured Event</span>
            @endif
        </div>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 max-w-4xl tracking-tight">{{ $event->title }}</h1>
        <p class="text-lg text-primary-200 max-w-2xl leading-relaxed mb-8">{{ $event->summary }}</p>
        <div class="flex flex-wrap gap-6 text-sm text-primary-200">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span class="font-medium text-white">{{ $event->start_date->format('l, F j, Y') }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ $event->start_date->format('g:i A') }} – {{ $event->end_date->format('g:i A') }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ $event->venue }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ $event->max_attendees }} seats max</span>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 50" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 50L1440 50L1440 15C1200 50 960 0 720 15C480 30 240 0 0 15L0 50Z" fill="white"/>
        </svg>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2 space-y-10">

                {{-- About --}}
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-4">About This Event</h2>
                    <div class="space-y-4 text-gray-600 leading-relaxed">
                        <p>Join us for <strong>{{ $event->title }}</strong> — one of VentureMatch's flagship events bringing together the most active investors, high-potential founders, and ecosystem enablers under one roof.</p>
                        <p>This event is designed to create meaningful connections, surface quality deal flow, and provide actionable insights from industry leaders who are actively deploying capital and building companies.</p>
                        <p>Whether you're an investor looking for your next portfolio company, a founder seeking capital and mentorship, or an ecosystem partner looking to engage — this event is built for you.</p>
                    </div>
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
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $h['icon'] }}"/></svg>
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
                        $agenda = [
                            ['time'=>'8:30 AM','title'=>'Registration & Welcome Coffee','type'=>'break'],
                            ['time'=>'9:00 AM','title'=>'Opening Keynote: The State of Investment in Emerging Markets','type'=>'keynote'],
                            ['time'=>'9:45 AM','title'=>'Panel: What Investors Look for in 2026','type'=>'panel'],
                            ['time'=>'10:45 AM','title'=>'Networking Break','type'=>'break'],
                            ['time'=>'11:00 AM','title'=>'Startup Pitch Session I — FinTech & HealthTech','type'=>'pitch'],
                            ['time'=>'12:00 PM','title'=>'Lunch & Curated Networking','type'=>'break'],
                            ['time'=>'1:30 PM','title'=>'Startup Pitch Session II — AgriTech & CleanTech','type'=>'pitch'],
                            ['time'=>'2:30 PM','title'=>'Workshop: Due Diligence Essentials','type'=>'workshop'],
                            ['time'=>'4:00 PM','title'=>'Fireside Chat: From Seed to Series B','type'=>'keynote'],
                            ['time'=>'5:00 PM','title'=>'Closing Remarks & Awards','type'=>'keynote'],
                            ['time'=>'5:30 PM','title'=>'Evening Networking Reception','type'=>'break'],
                        ];
                        $typeColors = ['keynote'=>'bg-primary-100 text-primary-700','panel'=>'bg-blue-100 text-blue-700','pitch'=>'bg-amber-100 text-amber-700','workshop'=>'bg-green-100 text-green-700','break'=>'bg-gray-100 text-gra