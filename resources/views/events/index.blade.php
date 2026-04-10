@extends('layouts.app')
@section('title', 'Events & Conferences')

@section('content')

{{-- Hero --}}
<div style="background:linear-gradient(135deg,#0d0a04,#1a1208,#241c0a);padding:5rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-5rem;right:-5rem;width:25rem;height:25rem;background:rgba(212,146,15,.07);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(212,146,15,.1);border:1px solid rgba(212,146,15,.25);color:rgba(212,146,15,.8);font-size:.75rem;font-weight:600;padding:.375rem 1rem;border-radius:9999px;margin-bottom:1.5rem;">
            <span style="width:.375rem;height:.375rem;background:#f59e0b;border-radius:50%;display:inline-block;"></span>
            Events & Conferences
        </span>
        <h1 style="font-size:clamp(2.5rem,6vw,3.75rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;color:#fff;letter-spacing:-.03em;">
            Where Deals Are <span style="color:#d4920f;">Made in Person</span>
        </h1>
        <p style="font-size:1.125rem;color:rgba(212,146,15,.6);max-width:32rem;line-height:1.7;margin:0 0 2rem;">
            Summits, showcases, networking nights, and workshops — connecting investors, founders, and ecosystem builders.
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:.625rem;">
            @php $types = ['All', 'Online', 'Offline', 'Hybrid']; @endphp
            @foreach($types as $t)
            <a href="{{ $t === 'All' ? route('events.index') : route('events.index', ['type' => strtolower($t)]) }}"
               style="padding:.5rem 1.125rem;border-radius:.75rem;font-size:.875rem;font-weight:600;text-decoration:none;{{ (request('type') === strtolower($t) || ($t === 'All' && !request('type'))) ? 'background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;' : 'background:rgba(255,255,255,.08);color:rgba(255,255,255,.7);border:1px solid rgba(212,146,15,.2);' }}">
                {{ $t }}
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- Featured Banner --}}
@php $featured = $upcoming->firstWhere('is_featured', true) ?? $upcoming->first(); @endphp
@if($featured)
<div style="background:#110e05;padding:1.5rem;border-bottom:1px solid rgba(212,146,15,.1);">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="background:linear-gradient(135deg,#1a1208,#2d2010);border:1px solid rgba(212,146,15,.25);border-radius:1.25rem;padding:1.5rem 2rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
            <div style="display:flex;align-items:center;gap:1rem;">
                <div style="width:3.5rem;height:3.5rem;background:rgba(212,146,15,.15);border-radius:.875rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="24" height="24" fill="none" stroke="#d4920f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                </div>
                <div>
                    <p style="color:rgba(212,146,15,.6);font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin:0 0 .25rem;">Featured Event</p>
                    <p style="color:#f0e6c8;font-weight:700;font-size:1rem;margin:0 0 .2rem;">{{ $featured->title }}</p>
                    <p style="color:#7a6a4a;font-size:.8125rem;margin:0;">{{ $featured->start_date->format('M d, Y · g:i A') }} · {{ $featured->venue ?? 'Online' }}</p>
                </div>
            </div>
            <a href="{{ route('events.show', $featured->slug) }}" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.625rem 1.5rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;white-space:nowrap;">View Details →</a>
        </div>
    </div>
</div>
@endif

{{-- Upcoming Events --}}
<div style="background:#0d0a04;padding:4rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2.5rem;flex-wrap:wrap;gap:1rem;">
            <div>
                <span style="font-size:.7rem;font-weight:700;color:#d4920f;text-transform:uppercase;letter-spacing:.1em;">Don't Miss Out</span>
                <h2 style="font-size:2rem;font-weight:800;color:#f0e6c8;margin:.5rem 0 0;letter-spacing:-.02em;">Upcoming Events</h2>
            </div>
            <form method="GET">
                <select name="category" onchange="this.form.submit()" style="background:#1a1408;border:1px solid rgba(212,146,15,.2);color:#c9b48a;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Categories</option>
                    @foreach(['Summit','Workshop','Networking','Showcase','Conference','Bootcamp'] as $cat)
                    <option value="{{ $cat }}" {{ request('category')===$cat?'selected':'' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        @php $gradients=['linear-gradient(135deg,#1d4ed8,#3b82f6)','linear-gradient(135deg,#7c3aed,#a78bfa)','linear-gradient(135deg,#059669,#34d399)','linear-gradient(135deg,#dc2626,#f97316)','linear-gradient(135deg,#d97706,#fbbf24)','linear-gradient(135deg,#0891b2,#22d3ee)']; @endphp

        @forelse($upcoming as $event)
        @if($loop->first)<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.25rem;">@endif

        <a href="{{ route('events.show', $event->slug) }}" style="text-decoration:none;background:#1a1408;border:1px solid rgba(212,146,15,.12);border-radius:1.25rem;overflow:hidden;display:flex;flex-direction:column;transition:all .25s;" onmouseover="this.style.boxShadow='0 12px 30px rgba(0,0,0,.4)';this.style.transform='translateY(-3px)';this.style.borderColor='rgba(212,146,15,.35)';" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)';this.style.borderColor='rgba(212,146,15,.12)';">
            @if($event->banner)
                <div style="position:relative;height:12rem;overflow:hidden;">
                    <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}" style="width:100%;height:100%;object-fit:cover;display:block;">
                    <div style="position:absolute;top:.75rem;left:.75rem;background:rgba(0,0,0,.5);color:#fff;font-size:.7rem;font-weight:700;padding:.2rem .625rem;border-radius:9999px;backdrop-filter:blur(4px);">{{ ucfirst($event->event_type) }}</div>
                    @if($event->is_featured)<div style="position:absolute;top:.75rem;right:.75rem;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-size:.7rem;font-weight:700;padding:.2rem .625rem;border-radius:9999px;">⭐ Featured</div>@endif
                </div>
            @else
                <div style="position:relative;height:12rem;background:{{ $gradients[$loop->index % 6] }};display:flex;align-items:center;justify-content:center;">
                    <svg width="40" height="40" fill="none" stroke="rgba(255,255,255,.5)" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <div style="position:absolute;top:.75rem;left:.75rem;background:rgba(0,0,0,.35);color:#fff;font-size:.7rem;font-weight:700;padding:.2rem .625rem;border-radius:9999px;border:1px solid rgba(255,255,255,.2);">{{ ucfirst($event->event_type) }}</div>
                    @if($event->is_featured)<div style="position:absolute;top:.75rem;right:.75rem;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-size:.7rem;font-weight:700;padding:.2rem .625rem;border-radius:9999px;">⭐ Featured</div>@endif
                </div>
            @endif
            <div style="padding:1.25rem;flex:1;display:flex;flex-direction:column;">
                <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;flex-wrap:wrap;">
                    @if($event->category)<span style="font-size:.68rem;background:rgba(212,146,15,.12);color:#d4920f;font-weight:600;padding:.2rem .6rem;border-radius:9999px;">{{ $event->category }}</span>@endif
                    @if($event->registration_open)
                    <span style="font-size:.68rem;background:rgba(5,150,105,.12);color:#34d399;font-weight:600;padding:.2rem .6rem;border-radius:9999px;display:flex;align-items:center;gap:.25rem;"><span style="width:.375rem;height:.375rem;background:#34d399;border-radius:50%;display:inline-block;"></span>Open</span>
                    @else
                    <span style="font-size:.68rem;background:rgba(255,255,255,.06);color:#6b5c3e;font-weight:600;padding:.2rem .6rem;border-radius:9999px;">Closed</span>
                    @endif
                </div>
                <h3 style="font-weight:700;color:#f0e6c8;margin:0 0 .5rem;line-height:1.4;font-size:.9375rem;flex:1;">{{ $event->title }}</h3>
                @if($event->summary)<p style="font-size:.78rem;color:#7a6a4a;margin:0 0 .875rem;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $event->summary }}</p>@endif
                <div style="font-size:.8125rem;color:#6b5c3e;display:flex;flex-direction:column;gap:.375rem;margin-bottom:.875rem;">
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <svg width="14" height="14" fill="none" stroke="#d4920f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $event->start_date->format('M d, Y · g:i A') }}
                    </div>
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <svg width="14" height="14" fill="none" stroke="#d4920f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $event->venue ?? 'Online Event' }}
                    </div>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:.875rem;border-top:1px solid rgba(212,146,15,.08);">
                    <span style="font-size:.72rem;color:#6b5c3e;">{{ $event->registrations_count ?? 0 }} registered</span>
                    <span style="font-size:.78rem;color:#d4920f;font-weight:600;">View Details →</span>
                </div>
            </div>
        </a>

        @if($loop->last)</div>@endif
        @empty
        <div style="text-align:center;padding:5rem 0;color:#6b5c3e;">
            <div style="font-size:3rem;margin-bottom:1rem;">📅</div>
            <p style="font-size:1.125rem;font-weight:500;color:#9a8a6a;">No upcoming events at the moment.</p>
        </div>
        @endforelse

        <div style="margin-top:2rem;">{{ $upcoming->withQueryString()->links() }}</div>
    </div>
</div>

{{-- Past Events --}}
@if($past->isNotEmpty())
<div style="background:#110e05;padding:4rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="margin-bottom:2rem;">
            <span style="font-size:.7rem;font-weight:700;color:rgba(212,146,15,.5);text-transform:uppercase;letter-spacing:.1em;">Look Back</span>
            <h2 style="font-size:2rem;font-weight:800;color:#f0e6c8;margin:.5rem 0 0;">Past Events</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1rem;">
            @foreach($past as $p)
            <a href="{{ route('events.show', $p->slug) }}" style="text-decoration:none;display:flex;align-items:center;gap:1rem;background:#1a1408;border:1px solid rgba(212,146,15,.1);border-radius:.875rem;padding:1rem;transition:all .2s;" onmouseover="this.style.borderColor='rgba(212,146,15,.3)';" onmouseout="this.style.borderColor='rgba(212,146,15,.1)';">
                <div style="width:3rem;height:3rem;border-radius:.75rem;background:rgba(212,146,15,.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="20" height="20" fill="none" stroke="#d4920f" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div style="flex:1;min-width:0;">
                    <p style="font-weight:600;color:#c9b48a;font-size:.875rem;margin:0 0 .2rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $p->title }}</p>
                    <p style="font-size:.75rem;color:#6b5c3e;margin:0;">{{ $p->start_date->format('M d, Y') }} · {{ $p->venue ?? 'Online' }}</p>
                </div>
                <span style="font-size:.68rem;background:rgba(255,255,255,.05);color:#6b5c3e;padding:.2rem .5rem;border-radius:9999px;flex-shrink:0;">{{ ucfirst($p->event_type) }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- Why Attend --}}
<div style="background:#0d0a04;padding:4rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3rem;">
            <span style="font-size:.7rem;font-weight:700;color:#d4920f;text-transform:uppercase;letter-spacing:.1em;">The Value</span>
            <h2 style="font-size:2rem;font-weight:800;color:#f0e6c8;margin:.5rem 0 0;">Why Attend VentureMatch Events?</h2>
        </div>
        @php $reasons=[['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','title'=>'Curated Networking','desc'=>'Every attendee is vetted — serious investors, founders, and ecosystem builders only.','c'=>'#3b82f6'],['icon'=>'M13 10V3L4 14h7v7l9-11h-7z','title'=>'Live Deal Flow','desc'=>'Startups pitch live, investors engage in real time — deals happen at our events.','c'=>'#f59e0b'],['icon'=>'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z','title'=>'Expert Insights','desc'=>'Keynotes from leading investors, operators, and policymakers shaping the ecosystem.','c'=>'#a855f7'],['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','title'=>'Verified Community','desc'=>'All participants are registered VentureMatch members — a trusted, high-quality community.','c'=>'#10b981']]; @endphp
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.25rem;">
            @foreach($reasons as $r)
            <div style="background:#1a1408;border:1px solid rgba(212,146,15,.12);border-radius:1rem;padding:1.75rem;text-align:center;">
                <div style="width:3.5rem;height:3.5rem;background:{{ $r['c'] }}18;border-radius:.875rem;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                    <svg width="22" height="22" fill="none" stroke="{{ $r['c'] }}" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $r['icon'] }}"/></svg>
                </div>
                <h4 style="font-weight:700;color:#f0e6c8;margin:0 0 .5rem;font-size:.9375rem;">{{ $r['title'] }}</h4>
                <p style="font-size:.8125rem;color:#7a6a4a;line-height:1.6;margin:0;">{{ $r['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- CTA --}}
<div style="background:linear-gradient(135deg,#1a1208,#241c0a);padding:4rem 1.5rem;text-align:center;">
    <div style="max-width:40rem;margin:0 auto;">
        <h2 style="font-size:2rem;font-weight:800;color:#fff;margin:0 0 .75rem;">Never Miss an Event</h2>
        <p style="color:rgba(212,146,15,.55);font-size:1rem;margin:0 0 2rem;line-height:1.6;">Subscribe to get early access, speaker announcements, and exclusive member discounts.</p>
        <form action="{{ route('newsletter.subscribe') }}" method="POST" style="display:flex;gap:.625rem;max-width:28rem;margin:0 auto;">
            @csrf
            <input type="email" name="email" placeholder="your@email.com" required style="flex:1;background:rgba(255,255,255,.06);border:1px solid rgba(212,146,15,.25);color:#fff;font-size:.875rem;border-radius:.625rem;padding:.625rem 1rem;outline:none;">
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.625rem 1.25rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.875rem;white-space:nowrap;">Notify Me</button>
        </form>
    </div>
</div>

@endsection
