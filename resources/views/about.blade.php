@extends('layouts.app')
@section('title', 'About')

@section('content')

{{-- Hero --}}
<div style="background:linear-gradient(135deg,#0d0a04 0%,#1a1208 50%,#241c0a 100%);padding:6rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-5rem;right:-5rem;width:25rem;height:25rem;background:rgba(212,146,15,.08);border-radius:50%;filter:blur(60px);"></div>
    <div style="position:absolute;bottom:-5rem;left:-5rem;width:20rem;height:20rem;background:rgba(212,146,15,.05);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(212,146,15,.1);border:1px solid rgba(212,146,15,.25);color:rgba(212,146,15,.8);font-size:.75rem;font-weight:600;padding:.375rem 1rem;border-radius:9999px;margin-bottom:1.5rem;">
            <span style="width:.375rem;height:.375rem;background:#f59e0b;border-radius:50%;display:inline-block;"></span>
            Our Story
        </span>
        <h1 style="font-size:clamp(2.5rem,6vw,4rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;letter-spacing:-.03em;color:#fff;max-width:36rem;">
            Building the Bridge Between <span style="color:#d4920f;">Capital & Innovation</span>
        </h1>
        <p style="font-size:1.125rem;color:rgba(212,146,15,.6);max-width:32rem;line-height:1.7;margin:0;">
            VentureMatch was founded with a single belief — that the right connection between an investor and a founder can change the world.
        </p>
    </div>
</div>

{{-- Who We Are --}}
<div style="background:#0d0a04;padding:5rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;">
        <div>
            <span style="font-size:.7rem;font-weight:700;color:#d4920f;text-transform:uppercase;letter-spacing:.1em;">Who We Are</span>
            <h2 style="font-size:2.25rem;font-weight:800;color:#f0e6c8;margin:.75rem 0 1.5rem;line-height:1.2;">
                {{ $sections['overview']->title ?? 'The Investment Ecosystem Platform' }}
            </h2>
            <div style="color:#9a8a6a;line-height:1.8;font-size:.9375rem;">
                @if(isset($sections['overview']))
                    {!! $sections['overview']->content !!}
                @else
                    <p style="margin:0 0 1rem;">VentureMatch is a curated investment ecosystem platform that connects investors, founders, startups, and ecosystem partners on a single, powerful platform.</p>
                    <p style="margin:0 0 1rem;">We believe that capital should flow to the best ideas — regardless of geography, network, or background.</p>
                    <p style="margin:0;">From angel investors to venture capital firms, from early-stage startups to growth-stage companies — VentureMatch serves the entire investment lifecycle.</p>
                @endif
            </div>
            <div style="margin-top:2rem;display:flex;flex-wrap:wrap;gap:.875rem;">
                <a href="{{ route('register.investor') }}" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.75rem 1.75rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;">Join as Investor</a>
                <a href="{{ route('register.seeker') }}" style="border:1px solid rgba(212,146,15,.4);color:#d4920f;font-weight:600;padding:.75rem 1.75rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;">Join as Seeker</a>
            </div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
            @php $highlights=[['value'=>'500+','label'=>'Registered Investors','color'=>'rgba(212,146,15,.08)','border'=>'rgba(212,146,15,.2)'],['value'=>'200+','label'=>'Startups Listed','color'=>'rgba(245,158,11,.08)','border'=>'rgba(245,158,11,.2)'],['value'=>'$50M+','label'=>'Capital Connected','color'=>'rgba(5,150,105,.08)','border'=>'rgba(5,150,105,.2)'],['value'=>'15+','label'=>'Countries Reached','color'=>'rgba(139,92,246,.08)','border'=>'rgba(139,92,246,.2)']]; @endphp
            @foreach($highlights as $h)
            <div style="background:{{ $h['color'] }};border:1px solid {{ $h['border'] }};border-radius:1rem;padding:1.5rem;text-align:center;">
                <p style="font-size:2rem;font-weight:800;color:#f0e6c8;margin:0 0 .25rem;">{{ $h['value'] }}</p>
                <p style="font-size:.8125rem;color:#7a6a4a;margin:0;">{{ $h['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Vision & Mission --}}
<div style="background:#110e05;padding:5rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <span style="font-size:.7rem;font-weight:700;color:#d4920f;text-transform:uppercase;letter-spacing:.1em;">What Drives Us</span>
            <h2 style="font-size:2.25rem;font-weight:800;color:#f0e6c8;margin:.75rem 0 0;">Vision & Mission</h2>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">
            <div style="background:#1a1408;border:1px solid rgba(212,146,15,.15);border-radius:1.5rem;padding:2.5rem;position:relative;overflow:hidden;">
                <div style="position:absolute;top:0;right:0;width:8rem;height:8rem;background:rgba(212,146,15,.05);border-radius:0 0 0 100%;"></div>
                <div style="width:3.5rem;height:3.5rem;background:rgba(212,146,15,.12);border-radius:.875rem;display:flex;align-items:center;justify-content:center;margin-bottom:1.5rem;">
                    <svg width="24" height="24" fill="none" stroke="#d4920f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 style="font-size:1.5rem;font-weight:700;color:#f0e6c8;margin:0 0 1rem;">{{ $sections['vision']->title ?? 'Our Vision' }}</h3>
                <p style="color:#9a8a6a;line-height:1.7;margin:0;">{{ $sections['vision']->content ?? 'To become the most trusted investment ecosystem platform in emerging markets — where every great idea finds the capital it deserves.' }}</p>
            </div>
            <div style="background:linear-gradient(135deg,#1a1208,#241c0a);border:1px solid rgba(212,146,15,.25);border-radius:1.5rem;padding:2.5rem;position:relative;overflow:hidden;">
                <div style="position:absolute;top:0;right:0;width:8rem;height:8rem;background:rgba(212,146,15,.08);border-radius:0 0 0 100%;"></div>
                <div style="width:3.5rem;height:3.5rem;background:rgba(212,146,15,.15);border-radius:.875rem;display:flex;align-items:center;justify-content:center;margin-bottom:1.5rem;">
                    <svg width="24" height="24" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 style="font-size:1.5rem;font-weight:700;color:#fff;margin:0 0 1rem;">{{ $sections['mission']->title ?? 'Our Mission' }}</h3>
                <p style="color:rgba(212,146,15,.65);line-height:1.7;margin:0;">{{ $sections['mission']->content ?? 'To democratize access to investment opportunities by building a transparent, efficient, and inclusive platform that empowers investors and founders.' }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Core Values --}}
<div style="background:#0d0a04;padding:5rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <span style="font-size:.7rem;font-weight:700;color:#d4920f;text-transform:uppercase;letter-spacing:.1em;">What We Stand For</span>
            <h2 style="font-size:2.25rem;font-weight:800;color:#f0e6c8;margin:.75rem 0 0;">Our Core Values</h2>
        </div>
        @php $values=[['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','title'=>'Trust & Transparency','desc'=>'Every interaction is built on verified data, honest communication, and mutual respect.','c'=>'#3b82f6'],['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','title'=>'Inclusive Access','desc'=>'Geography or network size never limits a founder\'s ability to raise capital.','c'=>'#10b981'],['icon'=>'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z','title'=>'Innovation First','desc'=>'We continuously evolve our platform to stay ahead of market needs.','c'=>'#f59e0b'],['icon'=>'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6','title'=>'Impact Driven','desc'=>'We measure success in businesses built, jobs created, and communities transformed.','c'=>'#a855f7'],['icon'=>'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z','title'=>'Security & Privacy','desc'=>'Sensitive information protected with enterprise-grade security standards.','c'=>'#ef4444'],['icon'=>'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9','title'=>'Global Mindset','desc'=>'Connecting capital and opportunity across borders and geographies.','c'=>'#06b6d4']]; @endphp
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;">
            @foreach($values as $v)
            <div style="background:#1a1408;border:1px solid rgba(212,146,15,.12);border-radius:1rem;padding:1.75rem;">
                <div style="width:3rem;height:3rem;background:{{ $v['c'] }}18;border-radius:.75rem;display:flex;align-items:center;justify-content:center;margin-bottom:1.25rem;">
                    <svg width="20" height="20" fill="none" stroke="{{ $v['c'] }}" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $v['icon'] }}"/></svg>
                </div>
                <h4 style="font-size:1rem;font-weight:700;color:#f0e6c8;margin:0 0 .5rem;">{{ $v['title'] }}</h4>
                <p style="font-size:.8125rem;color:#7a6a4a;line-height:1.6;margin:0;">{{ $v['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- How It Works --}}
<div style="background:#110e05;padding:5rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <span style="font-size:.7rem;font-weight:700;color:#d4920f;text-transform:uppercase;letter-spacing:.1em;">The Process</span>
            <h2 style="font-size:2.25rem;font-weight:800;color:#f0e6c8;margin:.75rem 0 .75rem;">How VentureMatch Works</h2>
            <p style="color:#7a6a4a;max-width:32rem;margin:0 auto;line-height:1.6;">A streamlined process designed to get the right capital to the right opportunity — fast.</p>
        </div>
        @php $steps=[['num'=>'01','title'=>'Register & Build Profile','desc'=>'Investors and seekers create verified profiles showcasing credentials, preferences, and goals.','icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],['num'=>'02','title'=>'Discover Opportunities','desc'=>'Browse curated, admin-verified opportunities filtered by sector, stage, and ticket size.','icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],['num'=>'03','title'=>'Express Interest','desc'=>'Save, shortlist, or request meetings directly — no cold emails needed.','icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],['num'=>'04','title'=>'Connect & Close','desc'=>'Both parties engage, negotiate, and close deals with full visibility.','icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z']]; @endphp
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;">
            @foreach($steps as $step)
            <div style="text-align:center;">
                <div style="width:5rem;height:5rem;background:#1a1408;border:2px solid rgba(212,146,15,.3);border-radius:1rem;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                    <svg width="28" height="28" fill="none" stroke="#d4920f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}"/></svg>
                </div>
                <span style="font-size:.65rem;font-weight:700;color:rgba(212,146,15,.5);letter-spacing:.1em;">STEP {{ $step['num'] }}</span>
                <h4 style="font-size:.9375rem;font-weight:700;color:#f0e6c8;margin:.375rem 0 .5rem;">{{ $step['title'] }}</h4>
                <p style="font-size:.8125rem;color:#7a6a4a;line-height:1.6;margin:0;">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Founder Message --}}
<div style="background:#0d0a04;padding:5rem 1.5rem;">
    <div style="max-width:64rem;margin:0 auto;display:grid;grid-template-columns:auto 1fr;gap:4rem;align-items:center;">
        <div style="text-align:center;">
            <div style="width:10rem;height:10rem;background:linear-gradient(135deg,#d4920f,#8f5c08);border-radius:1.5rem;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                <span style="color:#0d0a04;font-weight:800;font-size:3rem;">F</span>
            </div>
            <p style="font-weight:700;color:#f0e6c8;margin:0 0 .25rem;">{{ $sections['founder_message']->title ?? 'Founder & CEO' }}</p>
            <p style="color:#d4920f;font-size:.875rem;margin:0;">VentureMatch</p>
        </div>
        <div>
            <span style="font-size:.7rem;font-weight:700;color:#d4920f;text-transform:uppercase;letter-spacing:.1em;">A Message From Our Founder</span>
            <h2 style="font-size:1.875rem;font-weight:800;color:#f0e6c8;margin:.75rem 0 1.5rem;">Why We Built VentureMatch</h2>
            <div style="position:relative;padding-left:1.5rem;">
                <span style="position:absolute;left:0;top:-.5rem;font-size:3rem;color:rgba(212,146,15,.15);line-height:1;font-family:Georgia,serif;">"</span>
                <p style="color:#9a8a6a;line-height:1.8;font-style:italic;margin:0;font-size:.9375rem;">{{ $sections['founder_message']->content ?? "I've seen firsthand how difficult it is for brilliant founders to get in front of the right investors. VentureMatch was born to solve exactly that — making the investment ecosystem more accessible, transparent, and impactful for everyone involved." }}</p>
            </div>
        </div>
    </div>
</div>

{{-- CTA --}}
<div style="background:linear-gradient(135deg,#1a1208,#241c0a,#1a1208);padding:5rem 1.5rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-4rem;right:-4rem;width:20rem;height:20rem;background:rgba(212,146,15,.06);border-radius:50%;"></div>
    <div style="position:absolute;bottom:-4rem;left:-4rem;width:16rem;height:16rem;background:rgba(212,146,15,.04);border-radius:50%;"></div>
    <div style="max-width:48rem;margin:0 auto;position:relative;">
        <span style="display:inline-block;background:rgba(212,146,15,.1);border:1px solid rgba(212,146,15,.25);color:rgba(212,146,15,.8);font-size:.75rem;font-weight:600;padding:.375rem 1rem;border-radius:9999px;margin-bottom:1.5rem;">Ready to Get Started?</span>
        <h2 style="font-size:2.5rem;font-weight:800;color:#fff;margin:0 0 1rem;letter-spacing:-.02em;">Join the VentureMatch <span style="color:#d4920f;">Ecosystem Today</span></h2>
        <p style="color:rgba(212,146,15,.55);font-size:1.125rem;margin:0 0 2.5rem;line-height:1.6;">Whether you're an investor or a founder seeking capital — your journey starts here.</p>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem;">
            <a href="{{ route('register.investor') }}" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:1rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;">Join as Investor →</a>
            <a href="{{ route('register.seeker') }}" style="border:1px solid rgba(212,146,15,.35);color:#d4920f;font-weight:600;padding:1rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;">Join as Seeker →</a>
        </div>
    </div>
</div>

@endsection
