@extends('layouts.app')
@section('title', 'About')

@section('content')

@php
    $siteName = \App\Models\Setting::get('site_name', config('app.name'));
    $heroTitle   = $sections['hero']->title   ?? 'Building the Bridge Between Capital & Innovation';
    $heroContent = $sections['hero']->content ?? $siteName . ' was founded with a single belief — that the right connection between an investor and a founder can change the world.';
    $heroBadge   = $sections['hero']->extra['badge'] ?? 'Our Story';

    $overviewTitle   = $sections['overview']->title   ?? 'The Investment Ecosystem Platform';
    $overviewContent = $sections['overview']->content ?? '<p>'.e($siteName).' is a curated investment ecosystem platform that connects investors, founders, startups, and ecosystem partners on a single, powerful platform.</p><p>We believe that capital should flow to the best ideas — regardless of geography, network, or background.</p>';

    $visionTitle   = $sections['vision']->title   ?? 'Our Vision';
    $visionContent = $sections['vision']->content ?? 'To become the most trusted investment ecosystem platform in emerging markets — where every great idea finds the capital it deserves.';

    $missionTitle   = $sections['mission']->title   ?? 'Our Mission';
    $missionContent = $sections['mission']->content ?? 'To democratize access to investment opportunities by building a transparent, efficient, and inclusive platform that empowers investors and founders.';

    $founderTitle   = $sections['founder_message']->title   ?? 'Founder & CEO';
    $founderContent = $sections['founder_message']->content ?? "I've seen firsthand how difficult it is for brilliant founders to get in front of the right investors. ".e($siteName)." was born to solve exactly that — making the investment ecosystem more accessible, transparent, and impactful for everyone involved.";

    $highlights = $sections['highlights']->extra ?? [
        ['value'=>'500+','label'=>'Registered Investors'],
        ['value'=>'200+','label'=>'Startups Listed'],
        ['value'=>'$50M+','label'=>'Capital Connected'],
        ['value'=>'15+','label'=>'Countries Reached'],
    ];

    $boardMembers = $sections['board_members']->extra ?? [];
@endphp

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);color:#fff;padding:6rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-5rem;right:-5rem;width:25rem;height:25rem;background:rgba(249,115,22,.15);border-radius:50%;filter:blur(60px);"></div>
    <div style="position:absolute;bottom:-5rem;left:-5rem;width:20rem;height:20rem;background:rgba(249,115,22,.08);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-block;background:rgba(249,115,22,.2);border:1px solid rgba(249,115,22,.4);color:#fed7aa;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:1.5rem;text-transform:uppercase;letter-spacing:.08em;">{{ $heroBadge }}</span>
        <h1 style="font-size:clamp(2.5rem,6vw,4rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;letter-spacing:-.03em;max-width:36rem;">{!! $heroTitle !!}</h1>
        <p style="font-size:1.125rem;color:rgba(255,255,255,.8);max-width:32rem;line-height:1.7;margin:0;">{!! $heroContent !!}</p>
    </div>
</section>

{{-- Who We Are --}}
<section style="background:#f4f7fb;padding:5rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;">
        <div>
            <span style="display:inline-block;background:#eff6ff;border:1px solid #bfdbfe;color:#1a3c8f;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:.875rem;text-transform:uppercase;letter-spacing:.08em;">Who We Are</span>
            <h2 style="font-size:2.25rem;font-weight:800;color:#0d2b6e;margin:.75rem 0 1.5rem;line-height:1.2;">{{ $overviewTitle }}</h2>
            <div style="color:#8d98a1;line-height:1.8;font-size:.9375rem;">{!! $overviewContent !!}</div>
            <div style="margin-top:2rem;display:flex;flex-wrap:wrap;gap:.875rem;">
                <a href="{{ route('register.investor') }}" style="background:#f97316;color:#fff;font-weight:700;padding:.75rem 1.75rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;">Join as Investor</a>
                <a href="{{ route('register.seeker') }}" style="border:2px solid #1a3c8f;color:#1a3c8f;font-weight:600;padding:.75rem 1.75rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;">Join as Seeker</a>
            </div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
            @foreach($highlights as $h)
            <div style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.5rem;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                <p style="font-size:2rem;font-weight:800;color:#0d2b6e;margin:0 0 .25rem;">{{ $h['value'] }}</p>
                <p style="font-size:.8125rem;color:#8d98a1;margin:0;">{{ $h['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Vision & Mission --}}
<section style="background:#fff;padding:5rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <span style="display:inline-block;background:#eff6ff;border:1px solid #bfdbfe;color:#1a3c8f;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:.875rem;text-transform:uppercase;letter-spacing:.08em;">What Drives Us</span>
            <h2 style="font-size:2.25rem;font-weight:800;color:#0d2b6e;margin:.75rem 0 0;letter-spacing:-.02em;">Vision & Mission</h2>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">
            <div style="background:#f4f7fb;border:1px solid #dde3ea;border-radius:1.5rem;padding:2.5rem;position:relative;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(to right,#1a3c8f,#2563eb);"></div>
                <div style="width:3.5rem;height:3.5rem;background:#eff6ff;border-radius:.875rem;display:flex;align-items:center;justify-content:center;margin-bottom:1.5rem;">
                    <svg width="24" height="24" fill="none" stroke="#1a3c8f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 style="font-size:1.5rem;font-weight:700;color:#0d2b6e;margin:0 0 1rem;">{{ $visionTitle }}</h3>
                <p style="color:#8d98a1;line-height:1.7;margin:0;">{{ $visionContent }}</p>
            </div>
            <div style="background:#fff7ed;border:1px solid #fed7aa;border-radius:1.5rem;padding:2.5rem;position:relative;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(to right,#f97316,#fb923c);"></div>
                <div style="width:3.5rem;height:3.5rem;background:rgba(249,115,22,.12);border-radius:.875rem;display:flex;align-items:center;justify-content:center;margin-bottom:1.5rem;">
                    <svg width="24" height="24" fill="none" stroke="#f97316" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 style="font-size:1.5rem;font-weight:700;color:#0d2b6e;margin:0 0 1rem;">{{ $missionTitle }}</h3>
                <p style="color:#8d98a1;line-height:1.7;margin:0;">{{ $missionContent }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Founder Message --}}
<section style="background:#f4f7fb;padding:5rem 1.5rem;">
    <div style="max-width:64rem;margin:0 auto;display:grid;grid-template-columns:auto 1fr;gap:4rem;align-items:center;">
        <div style="text-align:center;">
            <div style="width:10rem;height:10rem;background:linear-gradient(135deg,#1a3c8f,#2563eb);border-radius:1.5rem;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;box-shadow:0 8px 24px rgba(26,60,143,.25);">
                <span style="color:#fff;font-weight:800;font-size:3rem;">{{ strtoupper(substr($founderTitle,0,1)) }}</span>
            </div>
            <p style="font-weight:700;color:#0d2b6e;margin:0 0 .25rem;">{{ $founderTitle }}</p>
            <p style="color:#f97316;font-size:.875rem;margin:0;font-weight:600;">{{ $siteName }}</p>
        </div>
        <div style="background:#fff;border:1px solid #dde3ea;border-radius:1.5rem;padding:2.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);position:relative;overflow:hidden;">
            <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(to right,#1a3c8f,#f97316);"></div>
            <span style="display:inline-block;background:#eff6ff;border:1px solid #bfdbfe;color:#1a3c8f;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:1rem;text-transform:uppercase;letter-spacing:.08em;">A Message From Our Founder</span>
            <h2 style="font-size:1.875rem;font-weight:800;color:#0d2b6e;margin:.75rem 0 1.5rem;">Why We Built {{ $siteName }}</h2>
            <div style="position:relative;padding-left:1.5rem;">
                <span style="position:absolute;left:0;top:-.5rem;font-size:3rem;color:rgba(26,60,143,.15);line-height:1;font-family:Georgia,serif;">"</span>
                <p style="color:#8d98a1;line-height:1.8;font-style:italic;margin:0;font-size:.9375rem;">{{ $founderContent }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Board Members (dynamic) --}}
@if(count($boardMembers) > 0)
<section style="background:#fff;padding:5rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2.5rem;flex-wrap:wrap;gap:1rem;">
            <div>
                <span style="display:inline-block;background:#eff6ff;border:1px solid #bfdbfe;color:#1a3c8f;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:.75rem;text-transform:uppercase;letter-spacing:.08em;">Our Team</span>
                <h2 style="font-size:2.25rem;font-weight:800;color:#0d2b6e;margin:0;letter-spacing:-.02em;">Board Members</h2>
            </div>
            <div style="display:flex;gap:.75rem;">
                <button id="boardPrev" style="width:2.5rem;height:2.5rem;border-radius:50%;border:2px solid #dde3ea;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;" onmouseover="this.style.borderColor='#1a3c8f';" onmouseout="this.style.borderColor='#dde3ea';"><svg width="16" height="16" fill="none" stroke="#374151" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg></button>
                <button id="boardNext" style="width:2.5rem;height:2.5rem;border-radius:50%;border:2px solid #dde3ea;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;" onmouseover="this.style.borderColor='#1a3c8f';" onmouseout="this.style.borderColor='#dde3ea';"><svg width="16" height="16" fill="none" stroke="#374151" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></button>
            </div>
        </div>
        <div style="overflow:hidden;">
        <div id="boardTrack" style="display:flex;gap:1.5rem;overflow-x:auto;scroll-behavior:smooth;scrollbar-width:none;padding-bottom:.5rem;">
            @php $grads=['linear-gradient(135deg,#0d2b6e,#2563eb)','linear-gradient(135deg,#14532d,#16a34a)','linear-gradient(135deg,#c2410c,#f97316)','linear-gradient(135deg,#5b21b6,#8b5cf6)','linear-gradient(135deg,#0e7490,#06b6d4)','linear-gradient(135deg,#3b0764,#a855f7)']; @endphp
            @foreach($boardMembers as $idx => $member)
            @php $initials = strtoupper(implode('', array_map(fn($w)=>$w[0], array_filter(explode(' ', $member['name']))))); @endphp
            <div style="flex-shrink:0;width:calc(25% - 1.125rem);min-width:220px;background:#fff;border:1px solid #dde3ea;border-radius:1.25rem;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04);transition:all .25s;" onmouseover="this.style.boxShadow='0 12px 30px rgba(26,60,143,.12)';this.style.transform='translateY(-3px)';" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,.04)';this.style.transform='translateY(0)';">
                <div style="height:7rem;background:{{ $grads[$idx % 6] }};position:relative;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                    <div style="position:absolute;inset:0;opacity:.07;background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:22px 22px;"></div>
                    @if(!empty($member['photo']))
                        <img src="{{ Storage::url($member['photo']) }}" alt="{{ $member['name'] }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:1;">
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.4),transparent);z-index:2;"></div>
                    @else
                        <div style="position:relative;z-index:2;width:3.5rem;height:3.5rem;border-radius:50%;background:rgba(255,255,255,.2);border:3px solid rgba(255,255,255,.4);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1rem;color:#fff;">{{ $initials }}</div>
                    @endif
                </div>
                <div style="padding:1.25rem;">
                    <h3 style="font-size:.9375rem;font-weight:700;color:#0d2b6e;margin:0 0 .25rem;">{{ $member['name'] }}</h3>
                    <p style="font-size:.75rem;font-weight:600;color:#6366f1;margin:0 0 .2rem;">{{ $member['role'] }}</p>
                    <p style="font-size:.7rem;color:#8d98a1;margin:0 0 .875rem;">{{ $member['org'] }}</p>
                    <p style="font-size:.78rem;color:#374151;line-height:1.6;margin:0;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $member['bio'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        </div>
    </div>
</section>
<script>
(function(){
    var track=document.getElementById('boardTrack');
    if(!track) return;
    document.getElementById('boardPrev').onclick=function(){ track.scrollLeft -= track.offsetWidth; };
    document.getElementById('boardNext').onclick=function(){ track.scrollLeft += track.offsetWidth; };
})();
</script>
@endif

{{-- CTA --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);padding:5rem 1.5rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-4rem;right:-4rem;width:20rem;height:20rem;background:rgba(249,115,22,.12);border-radius:50%;filter:blur(60px);"></div>
    <div style="position:absolute;bottom:-4rem;left:-4rem;width:16rem;height:16rem;background:rgba(249,115,22,.08);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:48rem;margin:0 auto;position:relative;">
        <span style="display:inline-block;background:rgba(249,115,22,.2);border:1px solid rgba(249,115,22,.4);color:#fed7aa;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:1.5rem;text-transform:uppercase;letter-spacing:.08em;">Ready to Get Started?</span>
        <h2 style="font-size:2.5rem;font-weight:800;color:#fff;margin:0 0 1rem;letter-spacing:-.02em;">Join the {{ $siteName }} <span style="color:#fb923c;">Ecosystem Today</span></h2>
        <p style="color:rgba(255,255,255,.75);font-size:1.125rem;margin:0 0 2.5rem;line-height:1.6;">Whether you're an investor or a founder seeking capital — your journey starts here.</p>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem;">
            <a href="{{ route('register.investor') }}" style="background:#f97316;color:#fff;font-weight:700;padding:1rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;">Join as Investor →</a>
            <a href="{{ route('register.seeker') }}" style="background:#1a3c8f;color:#fff;font-weight:700;padding:1rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;border:2px solid rgba(255,255,255,.3);">Join as Seeker →</a>
        </div>
    </div>
</section>

@endsection
