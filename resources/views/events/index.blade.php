@extends('layouts.app')
@section('title', 'Events & Conferences')

@section('content')

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);color:#fff;padding:5rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-5rem;right:-5rem;width:25rem;height:25rem;background:rgba(249,115,22,.15);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-block;background:rgba(249,115,22,.2);border:1px solid rgba(249,115,22,.4);color:#fed7aa;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:1.5rem;text-transform:uppercase;letter-spacing:.08em;">Events & Conferences</span>
        <h1 style="font-size:clamp(2.5rem,6vw,3.75rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;letter-spacing:-.03em;max-width:36rem;">
            Where Deals Are <span style="color:#fb923c;">Made in Person</span>
        </h1>
        <p style="font-size:1.125rem;color:rgba(255,255,255,.8);max-width:32rem;line-height:1.7;margin:0 0 2rem;">
            Summits, showcases, networking nights, and workshops — connecting investors, founders, and ecosystem builders.
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:.625rem;">
            @php $types = ['All', 'Online', 'Offline', 'Hybrid']; @endphp
            @foreach($types as $t)
            <a href="{{ $t === 'All' ? route('events.index') : route('events.index', ['type' => strtolower($t)]) }}"
               style="padding:.5rem 1.125rem;border-radius:.75rem;font-size:.875rem;font-weight:600;text-decoration:none;{{ (request('type') === strtolower($t) || ($t === 'All' && !request('type'))) ? 'background:#f97316;color:#fff;' : 'background:rgba(255,255,255,.15);color:rgba(255,255,255,.85);border:1px solid rgba(255,255,255,.25);' }}">
                {{ $t }}
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Featured Banner --}}
@php $featured = $upcoming->firstWhere('is_featured', true) ?? $upcoming->first(); @endphp
@if($featured)
<div style="background:#f4f7fb;padding:1.5rem;border-bottom:1px solid #dde3ea;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="background:#fff;border:1px solid #bfdbfe;border-radius:1.25rem;padding:1.5rem 2rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;box-shadow:0 2px 8px rgba(26,60,143,.08);">
            <div style="display:flex;align-items:center;gap:1rem;">
                <div style="width:3.5rem;height:3.5rem;background:#eff6ff;border-radius:.875rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="24" height="24" fill="none" stroke="#1a3c8f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                </div>
                <div>
                    <p style="color:#1a3c8f;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin:0 0 .25rem;">⭐ Featured Event</p>
                    <p style="color:#0d2b6e;font-weight:700;font-size:1rem;margin:0 0 .2rem;">{{ $featured->title }}</p>
                    <p style="font-size:.8125rem;color:#8d98a1;margin:0;">{{ $featured->start_date->format('M d, Y · g:i A') }} · {{ $featured->venue ?? 'Online' }}</p>
                </div>
            </div>
            <a href="{{ route('events.show', $featured->slug) }}" style="background:#f97316;color:#fff;font-weight:700;padding:.625rem 1.5rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;white-space:nowrap;">View Details →</a>
        </div>
    </div>
</div>
@endif

{{-- Upcoming Events --}}
<section style="background:#fff;padding:4rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2.5rem;flex-wrap:wrap;gap:1rem;">
            <div>
                <span style="display:inline-block;background:#eff6ff;border:1px solid #bfdbfe;color:#1a3c8f;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.08em;">Don't Miss Out</span>
                <h2 style="font-size:2rem;font-weight:800;color:#0d2b6e;margin:.5rem 0 0;letter-spacing:-.02em;">Upcoming Events</h2>
            </div>
            <form method="GET">
                <select name="category" onchange="this.form.submit()" style="background:#fff;border:1px solid #dde3ea;color:#374151;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Categories</option>
                    @foreach(['Summit','Workshop','Networking','Showcase','Conference','Bootcamp'] as $cat)
                    <option value="{{ $cat }}" {{ request('category')===$cat?'selected':'' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        @php
        $gradients=['linear-gradient(135deg,#1a3c8f,#2563eb)','linear-gradient(135deg,#7c3aed,#a78bfa)','linear-gradient(135deg,#16a34a,#34d399)','linear-gradient(135deg,#f97316,#fb923c)','linear-gradient(135deg,#d97706,#fbbf24)','linear-gradient(135deg,#0891b2,#22d3ee)'];
        $demoImages=[
            'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&q=80',
            'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=600&q=80',
            'https://images.unsplash.com/photo-1511578314322-379afb476865?w=600&q=80',
            'https://images.unsplash.com/photo-1591115765373-5207764f72e7?w=600&q=80',
            'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=600&q=80',
            'https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=600&q=80',
        ];
        @endphp

        @forelse($upcoming as $event)
        @if($loop->first)<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.25rem;">@endif
        @php $idx = $loop->index % 6; @endphp

        <a href="{{ route('events.show', $event->slug) }}" style="text-decoration:none;background:#fff;border:1px solid #e5e7eb;border-radius:1.25rem;overflow:hidden;display:flex;flex-direction:column;transition:all .25s;box-shadow:0 2px 12px rgba(0,0,0,.06);" onmouseover="this.style.boxShadow='0 12px 30px rgba(0,0,0,.12)';this.style.transform='translateY(-3px)';" onmouseout="this.style.boxShadow='0 2px 12px rgba(0,0,0,.06)';this.style.transform='translateY(0)';">
            <div style="position:relative;height:12rem;overflow:hidden;">
                @if($event->banner)
                    <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}" style="width:100%;height:100%;object-fit:cover;display:block;">
                @else
                    <img src="{{ $demoImages[$idx] }}" alt="{{ $event->title }}" style="width:100%;height:100%;object-fit:cover;display:block;">
                @endif
                <div style="position:absolute;top:.75rem;left:.75rem;background:rgba(255,255,255,.2);color:#fff;font-size:.7rem;font-weight:700;padding:.2rem .625rem;border-radius:9999px;backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,.3);text-transform:uppercase;letter-spacing:.04em;">{{ $event->event_type }}</div>
                @if($event->is_featured)<div style="position:absolute;top:.75rem;right:.75rem;background:#f97316;color:#fff;font-size:.7rem;font-weight:700;padding:.2rem .625rem;border-radius:9999px;">⭐ Featured</div>@endif
            </div>
            <div style="padding:1.25rem;flex:1;display:flex;flex-direction:column;">
                <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;flex-wrap:wrap;">
                    @if($event->category)<span style="font-size:.68rem;background:#eff6ff;color:#1a3c8f;font-weight:600;padding:.2rem .6rem;border-radius:9999px;">{{ $event->category }}</span>@endif
                    @if($event->registration_open)
                    <span style="font-size:.68rem;background:#f0fdf4;color:#16a34a;font-weight:600;padding:.2rem .6rem;border-radius:9999px;display:flex;align-items:center;gap:.25rem;"><span style="width:.375rem;height:.375rem;background:#16a34a;border-radius:50%;display:inline-block;"></span>Open</span>
                    @else
                    <span style="font-size:.68rem;background:#f1f5f9;color:#8d98a1;font-weight:600;padding:.2rem .6rem;border-radius:9999px;">Closed</span>
                    @endif
                </div>
                <h3 style="font-weight:700;color:#0d2b6e;margin:0 0 .5rem;line-height:1.4;font-size:.9375rem;flex:1;">{{ $event->title }}</h3>
                @if($event->summary)<p style="font-size:.78rem;color:#8d98a1;margin:0 0 .875rem;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $event->summary }}</p>@endif
                <div style="font-size:.8125rem;color:#8d98a1;display:flex;flex-direction:column;gap:.375rem;margin-bottom:.875rem;">
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <svg width="14" height="14" fill="none" stroke="#1a3c8f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $event->start_date->format('M d, Y · g:i A') }}
                    </div>
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <svg width="14" height="14" fill="none" stroke="#1a3c8f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $event->venue ?? 'Online Event' }}
                    </div>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:.875rem;border-top:1px solid #f1f5f9;">
                    <span style="font-size:.72rem;color:#8d98a1;">{{ $event->registrations_count ?? 0 }} registered</span>
                    <span style="font-size:.78rem;color:#f97316;font-weight:600;">View Details →</span>
                </div>
            </div>
        </a>

        @if($loop->last)</div>@endif
        @empty
        <div style="text-align:center;padding:5rem 0;">
            <div style="font-size:3rem;margin-bottom:1rem;">📅</div>
            <p style="font-size:1.125rem;font-weight:500;color:#8d98a1;">No upcoming events at the moment.</p>
        </div>
        @endforelse

        <div style="margin-top:2rem;">{{ $upcoming->withQueryString()->links() }}</div>
    </div>
</section>

{{-- Past Events --}}
@if($past->isNotEmpty())
<section style="background:#f4f7fb;padding:4rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="margin-bottom:2rem;">
            <span style="display:inline-block;background:#eff6ff;border:1px solid #bfdbfe;color:#1a3c8f;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.08em;">Look Back</span>
            <h2 style="font-size:2rem;font-weight:800;color:#0d2b6e;margin:.5rem 0 0;">Past Events</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1rem;">
            @foreach($past as $p)
            <a href="{{ route('events.show', $p->slug) }}" style="text-decoration:none;display:flex;align-items:center;gap:1rem;background:#fff;border:1px solid #dde3ea;border-radius:.875rem;padding:1rem;transition:all .2s;box-shadow:0 1px 4px rgba(0,0,0,.04);" onmouseover="this.style.borderColor='#bfdbfe';this.style.boxShadow='0 4px 12px rgba(26,60,143,.08)';" onmouseout="this.style.borderColor='#dde3ea';this.style.boxShadow='0 1px 4px rgba(0,0,0,.04)';">
                <div style="width:3rem;height:3rem;border-radius:.75rem;background:#eff6ff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="20" height="20" fill="none" stroke="#1a3c8f" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div style="flex:1;min-width:0;">
                    <p style="font-weight:600;color:#0d2b6e;font-size:.875rem;margin:0 0 .2rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $p->title }}</p>
                    <p style="font-size:.75rem;color:#8d98a1;margin:0;">{{ $p->start_date->format('M d, Y') }} · {{ $p->venue ?? 'Online' }}</p>
                </div>
                <span style="font-size:.68rem;background:#f1f5f9;color:#8d98a1;padding:.2rem .5rem;border-radius:9999px;flex-shrink:0;">{{ ucfirst($p->event_type) }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Why Attend --}}
<section style="background:#fff;padding:4rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3rem;">
            <span style="display:inline-block;background:#eff6ff;border:1px solid #bfdbfe;color:#1a3c8f;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.08em;">The Value</span>
            <h2 style="font-size:2rem;font-weight:800;color:#0d2b6e;margin:.5rem 0 0;letter-spacing:-.02em;">Why Attend VentureMatch Events?</h2>
        </div>
        @php $reasons=[
            ['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','title'=>'Curated Networking','desc'=>'Every attendee is vetted — serious investors, founders, and ecosystem builders only.','c'=>'#3b82f6','bg'=>'#eff6ff'],
            ['icon'=>'M13 10V3L4 14h7v7l9-11h-7z','title'=>'Live Deal Flow','desc'=>'Startups pitch live, investors engage in real time — deals happen at our events.','c'=>'#f97316','bg'=>'#fff7ed'],
            ['icon'=>'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z','title'=>'Expert Insights','desc'=>'Keynotes from leading investors, operators, and policymakers shaping the ecosystem.','c'=>'#a855f7','bg'=>'#faf5ff'],
            ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','title'=>'Verified Community','desc'=>'All participants are registered VentureMatch members — a trusted, high-quality community.','c'=>'#16a34a','bg'=>'#f0fdf4']
        ]; @endphp
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.25rem;">
            @foreach($reasons as $r)
            <div style="background:#f4f7fb;border:1px solid #dde3ea;border-radius:1rem;padding:1.75rem;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                <div style="width:3.5rem;height:3.5rem;background:{{ $r['bg'] }};border-radius:.875rem;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                    <svg width="22" height="22" fill="none" stroke="{{ $r['c'] }}" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $r['icon'] }}"/></svg>
                </div>
                <h4 style="font-weight:700;color:#0d2b6e;margin:0 0 .5rem;font-size:.9375rem;">{{ $r['title'] }}</h4>
                <p style="font-size:.8125rem;color:#8d98a1;line-height:1.6;margin:0;">{{ $r['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);padding:4rem 1.5rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-4rem;right:-4rem;width:20rem;height:20rem;background:rgba(249,115,22,.12);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:40rem;margin:0 auto;position:relative;">
        <h2 style="font-size:2rem;font-weight:800;color:#fff;margin:0 0 .75rem;">Never Miss an Event</h2>
        <p style="color:rgba(255,255,255,.75);font-size:1rem;margin:0 0 2rem;line-height:1.6;">Subscribe to get early access, speaker announcements, and exclusive member discounts.</p>
        <form action="{{ route('newsletter.subscribe') }}" method="POST" style="display:flex;gap:.625rem;max-width:28rem;margin:0 auto;">
            @csrf
            <input type="email" name="email" placeholder="your@email.com" required style="flex:1;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.25);color:#fff;font-size:.875rem;border-radius:.625rem;padding:.625rem 1rem;outline:none;">
            <button type="submit" style="background:#f97316;color:#fff;font-weight:700;padding:.625rem 1.25rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.875rem;white-space:nowrap;">Notify Me</button>
        </form>
    </div>
</section>

@endsection
