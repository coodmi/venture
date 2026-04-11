@extends('layouts.app')
@section('title', $event->title . ' — VentureMatch Events')
@section('meta_description', $event->summary ?? 'Join us at ' . $event->title)

@section('content')

{{-- Hero Banner --}}
<section style="position:relative;background:linear-gradient(135deg,#0d0a04,#1a1208,#241c0a);color:#f0e6c8;overflow:hidden;">
    @if($event->banner)
        <div style="position:absolute;inset:0;">
            <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}" style="width:100%;height:100%;object-fit:cover;opacity:.18;">
            <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(13,10,4,.92),rgba(26,18,8,.82));"></div>
        </div>
    @else
        <div style="position:absolute;inset:0;opacity:.08;">
            <div style="position:absolute;top:2.5rem;left:5rem;width:20rem;height:20rem;background:#d4920f;border-radius:9999px;filter:blur(80px);"></div>
            <div style="position:absolute;bottom:0;right:2.5rem;width:24rem;height:24rem;background:#f59e0b;border-radius:9999px;filter:blur(80px);"></div>
        </div>
    @endif
    <div style="position:relative;max-width:80rem;margin:0 auto;padding:5rem 1.5rem 7rem;">
        <a href="{{ route('events.index') }}" style="display:inline-flex;align-items:center;gap:.5rem;color:rgba(212,146,15,.6);font-size:.875rem;margin-bottom:2rem;text-decoration:none;">
            <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Events
        </a>
        <div style="display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.25rem;">
            <span style="background:rgba(212,146,15,.12);border:1px solid rgba(212,146,15,.25);color:#d4920f;font-size:.75rem;font-weight:700;padding:.375rem .75rem;border-radius:9999px;">
                {{ ucfirst($event->event_type) }}
            </span>
            @if($event->category)
            <span style="background:rgba(212,146,15,.18);border:1px solid rgba(212,146,15,.3);color:#f0e6c8;font-size:.75rem;font-weight:700;padding:.375rem .75rem;border-radius:9999px;">
                {{ $event->category }}
            </span>
            @endif
            @if($event->is_featured)
            <span style="background:rgba(212,146,15,.25);border:1px solid rgba(212,146,15,.4);color:#d4920f;font-size:.75rem;font-weight:700;padding:.375rem .75rem;border-radius:9999px;">
                ⭐ Featured Event
            </span>
            @endif
        </div>
        <h1 style="font-size:clamp(2rem,5vw,3.5rem);font-weight:800;line-height:1.15;margin-bottom:1.5rem;max-width:56rem;color:#f0e6c8;">
            {{ $event->title }}
        </h1>
        @if($event->summary)
        <p style="font-size:1.125rem;color:#9a8a6a;max-width:40rem;line-height:1.7;margin-bottom:2rem;">{{ $event->summary }}</p>
        @endif
        <div style="display:flex;flex-wrap:wrap;gap:1.5rem;font-size:.875rem;color:#9a8a6a;">
            <div style="display:flex;align-items:center;gap:.5rem;">
                <svg style="width:1.25rem;height:1.25rem;color:#d4920f;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span style="font-weight:600;color:#f0e6c8;">{{ $event->start_date->format('l, F j, Y') }}</span>
            </div>
            <div style="display:flex;align-items:center;gap:.5rem;">
                <svg style="width:1.25rem;height:1.25rem;color:#d4920f;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ $event->start_date->format('g:i A') }}{{ $event->end_date ? ' – ' . $event->end_date->format('g:i A') : '' }}</span>
            </div>
            <div style="display:flex;align-items:center;gap:.5rem;">
                <svg style="width:1.25rem;height:1.25rem;color:#d4920f;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ $event->venue ?? 'Online Event' }}</span>
            </div>
            @if($event->max_attendees)
            <div style="display:flex;align-items:center;gap:.5rem;">
                <svg style="width:1.25rem;height:1.25rem;color:#d4920f;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ $event->max_attendees }} seats max</span>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- Main Content --}}
<section style="padding:4rem 0;background:#0d0a04;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:grid;grid-template-columns:1fr;gap:2.5rem;">
            <div style="display:grid;grid-template-columns:1fr 340px;gap:2.5rem;align-items:start;">

            {{-- Left: Details --}}
            <div style="display:flex;flex-direction:column;gap:2.5rem;">

                {{-- About --}}
                <div>
                    <h2 style="font-size:1.5rem;font-weight:800;color:#f0e6c8;margin-bottom:1rem;">About This Event</h2>
                    @if($event->description)
                        <div style="color:#9a8a6a;line-height:1.75;">{!! $event->description !!}</div>
                    @else
                        <div style="display:flex;flex-direction:column;gap:1rem;color:#9a8a6a;line-height:1.75;">
                            <p>Join us for <strong style="color:#f0e6c8;">{{ $event->title }}</strong> — one of VentureMatch's flagship events bringing together the most active investors, high-potential founders, and ecosystem enablers under one roof.</p>
                            <p>This event is designed to create meaningful connections, surface quality deal flow, and provide actionable insights from industry leaders who are actively deploying capital and building companies.</p>
                            <p>Whether you're an investor looking for your next portfolio company, a founder seeking capital and mentorship, or an ecosystem partner looking to engage — this event is built for you.</p>
                        </div>
                    @endif
                </div>

                {{-- What to Expect --}}
                <div>
                    <h2 style="font-size:1.5rem;font-weight:800;color:#f0e6c8;margin-bottom:1.5rem;">What to Expect</h2>
                    @php
                        $highlights = [
                            ['icon'=>'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z','title'=>'Keynote Speakers','desc'=>'Hear from leading investors and operators sharing real insights on deal-making and market trends.'],
                            ['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','title'=>'Curated Networking','desc'=>'Structured networking sessions with pre-matched investor-founder meetings and open networking.'],
                            ['icon'=>'M13 10V3L4 14h7v7l9-11h-7z','title'=>'Live Pitches','desc'=>'Watch vetted startups pitch live to a panel of investors — and see deals happen in real time.'],
                            ['icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z','title'=>'Verified Attendees','desc'=>'Every attendee is a registered VentureMatch member — no noise, just serious participants.'],
                        ];
                    @endphp
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                        @foreach($highlights as $h)
                        <div style="display:flex;gap:1rem;padding:1.25rem;background:#1a1408;border-radius:1.25rem;border:1px solid rgba(212,146,15,.15);">
                            <div style="width:2.75rem;height:2.75rem;background:rgba(212,146,15,.12);border-radius:.75rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg style="width:1.25rem;height:1.25rem;color:#d4920f;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $h['icon'] }}"/>
                                </svg>
                            </div>
                            <div>
                                <h4 style="font-weight:700;color:#f0e6c8;font-size:.875rem;margin-bottom:.25rem;">{{ $h['title'] }}</h4>
                                <p style="font-size:.75rem;color:#7a6a4a;line-height:1.6;">{{ $h['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Agenda --}}
                <div>
                    <h2 style="font-size:1.5rem;font-weight:800;color:#f0e6c8;margin-bottom:1.5rem;">Event Agenda</h2>
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
                        $typeColors = [
                            'keynote' => 'rgba(212,146,15,.18)',
                            'panel'   => 'rgba(59,130,246,.15)',
                            'pitch'   => 'rgba(245,158,11,.15)',
                            'workshop'=> 'rgba(16,185,129,.15)',
                            'break'   => 'rgba(255,255,255,.04)',
                        ];
                        $typeTextColors = [
                            'keynote' => '#d4920f',
                            'panel'   => '#60a5fa',
                            'pitch'   => '#f59e0b',
                            'workshop'=> '#34d399',
                            'break'   => '#7a6a4a',
                        ];
                    @endphp
                    <div style="display:flex;flex-direction:column;gap:.5rem;">
                        @foreach($agendaItems as $item)
                        @php
                            $t = is_array($item) ? ($item['type'] ?? 'break') : 'break';
                            $bg = $typeColors[$t] ?? 'rgba(255,255,255,.04)';
                            $tc = $typeTextColors[$t] ?? '#7a6a4a';
                        @endphp
                        <div style="display:flex;align-items:center;gap:1rem;padding:1rem;border-radius:.75rem;background:{{ $bg }};border:1px solid rgba(212,146,15,.08);">
                            <div style="width:5rem;font-size:.75rem;font-weight:700;color:#7a6a4a;flex-shrink:0;">
                                {{ is_array($item) ? $item['time'] : '' }}
                            </div>
                            <div style="flex:1;">
                                <p style="font-size:.875rem;font-weight:600;color:#f0e6c8;">{{ is_array($item) ? $item['title'] : $item }}</p>
                            </div>
                            <span style="font-size:.75rem;font-weight:600;padding:.25rem .625rem;border-radius:9999px;background:rgba(212,146,15,.1);color:{{ $tc }};flex-shrink:0;text-transform:capitalize;">
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
                    <h2 style="font-size:1.5rem;font-weight:800;color:#f0e6c8;margin-bottom:1.5rem;">Speakers</h2>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                        @foreach($speakers as $speaker)
                        <div style="display:flex;align-items:center;gap:1rem;padding:1.25rem;background:#1a1408;border-radius:1.25rem;border:1px solid rgba(212,146,15,.15);">
                            <div style="width:3.5rem;height:3.5rem;background:linear-gradient(135deg,#d4920f,#f59e0b);border-radius:1rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <span style="color:#0d0a04;font-weight:800;font-size:1.25rem;">
                                    {{ strtoupper(substr(is_array($speaker) ? $speaker['name'] : $speaker, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <p style="font-weight:700;color:#f0e6c8;font-size:.875rem;">{{ is_array($speaker) ? $speaker['name'] : $speaker }}</p>
                                @if(is_array($speaker) && isset($speaker['role']))
                                <p style="font-size:.75rem;color:#d4920f;font-weight:500;margin-top:.125rem;">{{ $speaker['role'] }}</p>
                                @endif
                                @if(is_array($speaker) && isset($speaker['bio']))
                                <p style="font-size:.75rem;color:#7a6a4a;margin-top:.25rem;line-height:1.5;">{{ $speaker['bio'] }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>{{-- end left --}}

            {{-- Right: Sidebar --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;position:sticky;top:6rem;">

                {{-- Registration Card --}}
                <div style="background:#1a1408;border-radius:1.25rem;border:2px solid {{ $event->registration_open ? '#d4920f' : 'rgba(212,146,15,.15)' }};overflow:hidden;">
                    @if($event->registration_open)
                    <div style="background:linear-gradient(135deg,#d4920f,#f59e0b);padding:.75rem 1.25rem;display:flex;align-items:center;justify-content:space-between;">
                        <span style="color:#0d0a04;font-weight:700;font-size:.875rem;">Registration Open</span>
                        <span style="display:flex;align-items:center;gap:.375rem;color:#0d0a04;font-size:.75rem;font-weight:600;">
                            <span style="width:.5rem;height:.5rem;background:#0d0a04;border-radius:9999px;opacity:.7;"></span> Live
                        </span>
                    </div>
                    @else
                    <div style="background:rgba(122,106,74,.3);padding:.75rem 1.25rem;">
                        <span style="color:#9a8a6a;font-weight:700;font-size:.875rem;">Registration Closed</span>
                    </div>
                    @endif

                    <div style="padding:1.25rem;">
                        {{-- Event Quick Info --}}
                        <div style="display:flex;flex-direction:column;gap:.75rem;margin-bottom:1.25rem;padding-bottom:1.25rem;border-bottom:1px solid rgba(212,146,15,.1);">
                            <div style="display:flex;align-items:flex-start;gap:.75rem;">
                                <svg style="width:1rem;height:1rem;color:#d4920f;margin-top:.125rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <div>
                                    <p style="font-size:.75rem;color:#7a6a4a;">Date</p>
                                    <p style="font-size:.875rem;font-weight:600;color:#f0e6c8;">{{ $event->start_date->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div style="display:flex;align-items:flex-start;gap:.75rem;">
                                <svg style="width:1rem;height:1rem;color:#d4920f;margin-top:.125rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <div>
                                    <p style="font-size:.75rem;color:#7a6a4a;">Time</p>
                                    <p style="font-size:.875rem;font-weight:600;color:#f0e6c8;">{{ $event->start_date->format('g:i A') }}{{ $event->end_date ? ' – '.$event->end_date->format('g:i A') : '' }}</p>
                                </div>
                            </div>
                            <div style="display:flex;align-items:flex-start;gap:.75rem;">
                                <svg style="width:1rem;height:1rem;color:#d4920f;margin-top:.125rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <div>
                                    <p style="font-size:.75rem;color:#7a6a4a;">Venue</p>
                                    <p style="font-size:.875rem;font-weight:600;color:#f0e6c8;">{{ $event->venue ?? 'Online Event' }}</p>
                                    @if($event->online_link && $event->event_type !== 'offline')
                                    <a href="{{ $event->online_link }}" target="_blank" style="font-size:.75rem;color:#d4920f;text-decoration:none;">Join Online →</a>
                                    @endif
                                </div>
                            </div>
                            <div style="display:flex;align-items:flex-start;gap:.75rem;">
                                <svg style="width:1rem;height:1rem;color:#d4920f;margin-top:.125rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                <div>
                                    <p style="font-size:.75rem;color:#7a6a4a;">Type</p>
                                    <p style="font-size:.875rem;font-weight:600;color:#f0e6c8;">{{ ucfirst($event->event_type) }}{{ $event->category ? ' · '.$event->category : '' }}</p>
                                </div>
                            </div>
                            @if($event->max_attendees)
                            <div style="display:flex;align-items:flex-start;gap:.75rem;">
                                <svg style="width:1rem;height:1rem;color:#d4920f;margin-top:.125rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <div>
                                    <p style="font-size:.75rem;color:#7a6a4a;">Capacity</p>
                                    <p style="font-size:.875rem;font-weight:600;color:#f0e6c8;">{{ $event->max_attendees }} seats</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Registration Form --}}
                        @if($event->registration_open)
                            @if(session('success'))
                            <div style="background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.3);color:#34d399;padding:.75rem 1rem;border-radius:.75rem;font-size:.875rem;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;">
                                <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ session('success') }}
                            </div>
                            @endif
                            @if($errors->any())
                            <div style="background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.3);color:#f87171;padding:.75rem 1rem;border-radius:.75rem;font-size:.875rem;margin-bottom:1rem;">
                                {{ $errors->first() }}
                            </div>
                            @endif
                            <form method="POST" action="{{ route('events.register', $event) }}" style="display:flex;flex-direction:column;gap:.75rem;">
                                @csrf
                                <div>
                                    <label style="display:block;font-size:.75rem;font-weight:600;color:#9a8a6a;margin-bottom:.25rem;">Full Name <span style="color:#f87171;">*</span></label>
                                    <input type="text" name="name" required value="{{ old('name', auth()->user()?->name) }}"
                                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);border-radius:.75rem;padding:.625rem .75rem;font-size:.875rem;color:#f0e6c8;outline:none;box-sizing:border-box;">
                                </div>
                                <div>
                                    <label style="display:block;font-size:.75rem;font-weight:600;color:#9a8a6a;margin-bottom:.25rem;">Email <span style="color:#f87171;">*</span></label>
                                    <input type="email" name="email" required value="{{ old('email', auth()->user()?->email) }}"
                                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);border-radius:.75rem;padding:.625rem .75rem;font-size:.875rem;color:#f0e6c8;outline:none;box-sizing:border-box;">
                                </div>
                                <div>
                                    <label style="display:block;font-size:.75rem;font-weight:600;color:#9a8a6a;margin-bottom:.25rem;">Phone</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}"
                                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);border-radius:.75rem;padding:.625rem .75rem;font-size:.875rem;color:#f0e6c8;outline:none;box-sizing:border-box;">
                                </div>
                                <div>
                                    <label style="display:block;font-size:.75rem;font-weight:600;color:#9a8a6a;margin-bottom:.25rem;">Organization</label>
                                    <input type="text" name="organization" value="{{ old('organization') }}"
                                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);border-radius:.75rem;padding:.625rem .75rem;font-size:.875rem;color:#f0e6c8;outline:none;box-sizing:border-box;">
                                </div>
                                <div>
                                    <label style="display:block;font-size:.75rem;font-weight:600;color:#9a8a6a;margin-bottom:.25rem;">Designation</label>
                                    <input type="text" name="designation" value="{{ old('designation') }}"
                                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);border-radius:.75rem;padding:.625rem .75rem;font-size:.875rem;color:#f0e6c8;outline:none;box-sizing:border-box;">
                                </div>
                                <button type="submit"
                                        style="width:100%;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.75rem;border-radius:.75rem;border:none;cursor:pointer;font-size:.875rem;">
                                    Register Now — Free
                                </button>
                                <p style="font-size:.75rem;color:#7a6a4a;text-align:center;">You'll receive a confirmation email after registration.</p>
                            </form>
                        @else
                            <div style="text-align:center;padding:1rem 0;">
                                <p style="font-size:.875rem;color:#7a6a4a;margin-bottom:.75rem;">Registration for this event is currently closed.</p>
                                <a href="{{ route('events.index') }}" style="color:#d4920f;font-size:.875rem;font-weight:600;text-decoration:none;">Browse other events →</a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Share --}}
                <div style="background:#1a1408;border-radius:1.25rem;border:1px solid rgba(212,146,15,.15);padding:1.25rem;">
                    <h4 style="font-weight:700;color:#f0e6c8;font-size:.875rem;margin-bottom:.75rem;">Share This Event</h4>
                    <div style="display:flex;gap:.5rem;">
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank"
                           style="flex:1;display:flex;align-items:center;justify-content:center;gap:.5rem;background:#0a66c2;color:#fff;font-size:.75rem;font-weight:600;padding:.625rem;border-radius:.75rem;text-decoration:none;">
                            <svg style="width:1rem;height:1rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            LinkedIn
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($event->title) }}&url={{ urlencode(url()->current()) }}" target="_blank"
                           style="flex:1;display:flex;align-items:center;justify-content:center;gap:.5rem;background:#0ea5e9;color:#fff;font-size:.75rem;font-weight:600;padding:.625rem;border-radius:.75rem;text-decoration:none;">
                            <svg style="width:1rem;height:1rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            Twitter
                        </a>
                    </div>
                </div>

            </div>{{-- end sidebar --}}
            </div>{{-- end grid --}}
        </div>
    </div>
</section>

{{-- More Events --}}
<section style="padding:4rem 0;background:#0d0a04;border-top:1px solid rgba(212,146,15,.1);">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;">
            <h2 style="font-size:1.5rem;font-weight:800;color:#f0e6c8;">More Events</h2>
            <a href="{{ route('events.index') }}" style="color:#d4920f;font-size:.875rem;font-weight:600;text-decoration:none;">View all →</a>
        </div>
        @php
            $gradients = ['#1a1408','#1a1408','#1a1408','#1a1408','#1a1408','#1a1408'];
            $icons     = ['💡','🤝','📊','🌍','🏆','🚀'];
        @endphp
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;">
            @forelse($moreEvents as $more)
            <a href="{{ route('events.show', $more->slug) }}"
               style="background:#1a1408;border-radius:1.25rem;border:1px solid rgba(212,146,15,.15);overflow:hidden;text-decoration:none;display:block;">
                @if($more->banner)
                    <img src="{{ Storage::url($more->banner) }}" alt="{{ $more->title }}" style="width:100%;height:8rem;object-fit:cover;">
                @else
                    <div style="height:8rem;background:linear-gradient(135deg,#1a1408,#241c0a);display:flex;align-items:center;justify-content:center;">
                        <span style="font-size:2.5rem;">{{ $icons[$loop->index % count($icons)] }}</span>
                    </div>
                @endif
                <div style="padding:1rem;">
                    <h4 style="font-weight:700;color:#f0e6c8;font-size:.875rem;margin-bottom:.5rem;">{{ $more->title }}</h4>
                    <p style="font-size:.75rem;color:#7a6a4a;display:flex;align-items:center;gap:.375rem;margin-bottom:.25rem;">
                        <svg style="width:.875rem;height:.875rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $more->start_date->format('M d, Y') }}
                    </p>
                    <p style="font-size:.75rem;color:#7a6a4a;display:flex;align-items:center;gap:.375rem;">
                        <svg style="width:.875rem;height:.875rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $more->venue ?? 'Online' }}
                    </p>
                </div>
            </a>
            @empty
            <div style="grid-column:span 3;text-align:center;padding:2rem;color:#7a6a4a;font-size:.875rem;">No other upcoming events right now.</div>
            @endforelse
        </div>
    </div>
</section>

@endsection
