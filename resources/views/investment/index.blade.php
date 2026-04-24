@extends('layouts.app')
@section('title', 'Investment Opportunities')

@section('content')
@php
    $sectorColors=['FinTech'=>'#3b82f6','AgriTech'=>'#10b981','HealthTech'=>'#ef4444','EdTech'=>'#f97316','CleanTech'=>'#8b5cf6','E-Commerce'=>'#0891b2','FoodTech'=>'#f59e0b','LogiTech'=>'#6366f1'];
@endphp

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);color:#fff;padding:5rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-5rem;right:-5rem;width:28rem;height:28rem;background:rgba(249,115,22,.15);border-radius:50%;filter:blur(70px);"></div>
    <div style="position:absolute;bottom:-5rem;left:-5rem;width:20rem;height:20rem;background:rgba(255,255,255,.05);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-block;background:rgba(249,115,22,.2);border:1px solid rgba(249,115,22,.4);color:#fed7aa;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:1.5rem;text-transform:uppercase;letter-spacing:.08em;">🚀 Live Opportunities</span>
        <h1 style="font-size:clamp(2.5rem,6vw,4rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;letter-spacing:-.03em;max-width:40rem;">
            Discover & Invest in <span style="color:#fb923c;">Tomorrow's Ventures</span>
        </h1>
        <p style="font-size:1.125rem;color:rgba(255,255,255,.8);max-width:36rem;line-height:1.7;margin:0 0 2.5rem;">
            Browse verified, high-potential investment opportunities across sectors. Connect directly with founders and deploy capital with confidence.
        </p>
        {{-- Stats --}}
        <div style="display:flex;flex-wrap:wrap;gap:2rem;">
            <div><p style="font-size:2rem;font-weight:800;color:#fff;margin:0;line-height:1;">{{ $stats['total'] }}+</p><p style="font-size:.8rem;color:rgba(255,255,255,.65);margin:.25rem 0 0;">Total Opportunities</p></div>
            <div style="width:1px;background:rgba(255,255,255,.15);"></div>
            <div><p style="font-size:2rem;font-weight:800;color:#fb923c;margin:0;line-height:1;">{{ $stats['hot'] }}</p><p style="font-size:.8rem;color:rgba(255,255,255,.65);margin:.25rem 0 0;">Hot Deals</p></div>
            <div style="width:1px;background:rgba(255,255,255,.15);"></div>
            <div><p style="font-size:2rem;font-weight:800;color:#fff;margin:0;line-height:1;">{{ $stats['featured'] }}</p><p style="font-size:.8rem;color:rgba(255,255,255,.65);margin:.25rem 0 0;">Featured</p></div>
            <div style="width:1px;background:rgba(255,255,255,.15);"></div>
            <div><p style="font-size:2rem;font-weight:800;color:#fff;margin:0;line-height:1;">{{ $stats['sectors'] }}</p><p style="font-size:.8rem;color:rgba(255,255,255,.65);margin:.25rem 0 0;">Sectors</p></div>
        </div>
    </div>
</section>

{{-- Quick Type Filter --}}
<div style="background:#fff;border-bottom:1px solid #dde3ea;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;display:flex;gap:0;overflow-x:auto;">
        @php $types=[['key'=>'','label'=>'All Deals'],['key'=>'hot','label'=>'🔥 Hot Deals'],['key'=>'featured','label'=>'⭐ Featured']]; @endphp
        @foreach($types as $t)
        <a href="{{ route('investment.index', array_merge(request()->except('type','page'), $t['key']?['type'=>$t['key']]:[]) ) }}"
           style="padding:1rem 1.5rem;font-size:.875rem;font-weight:600;text-decoration:none;white-space:nowrap;border-bottom:3px solid {{ request('type')===$t['key']||($t['key']===''&&!request('type'))?'#1a3c8f':'transparent' }};color:{{ request('type')===$t['key']||($t['key']===''&&!request('type'))?'#1a3c8f':'#8d98a1' }};transition:all .2s;">
            {{ $t['label'] }}
        </a>
        @endforeach
    </div>
</div>

{{-- Main --}}
<section style="background:#f4f7fb;padding:3rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">

        {{-- Filters --}}
        <form method="GET" style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.25rem;margin-bottom:2rem;display:flex;flex-wrap:wrap;gap:.875rem;align-items:flex-end;box-shadow:0 2px 8px rgba(0,0,0,.04);">
            @if(request('type'))<input type="hidden" name="type" value="{{ request('type') }}">@endif
            <div style="flex:1;min-width:200px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search opportunities..."
                    style="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;box-sizing:border-box;">
            </div>
            <div style="min-width:150px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Sector</label>
                <select name="sector" style="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Sectors</option>
                    @foreach($sectors as $s)
                    <option value="{{ $s }}" {{ request('sector')===$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:150px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Stage</label>
                <select name="stage" style="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Stages</option>
                    @foreach($stages as $s)
                    <option value="{{ $s }}" {{ request('stage')===$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="background:#1a3c8f;color:#fff;font-weight:700;padding:.5rem 1.25rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;">Filter</button>
            @if(request()->hasAny(['search','sector','stage','type']))
            <a href="{{ route('investment.index') }}" style="font-size:.875rem;color:#8d98a1;text-decoration:none;padding:.5rem 0;">✕ Clear</a>
            @endif
        </form>

        <p style="font-size:.875rem;color:#8d98a1;margin-bottom:1.5rem;">{{ $opportunities->total() }} opportunit{{ $opportunities->total()!=1?'ies':'y' }} found</p>

        @if($opportunities->isEmpty())
        <div style="text-align:center;padding:5rem 0;background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;">
            <svg width="64" height="64" fill="none" stroke="#bfdbfe" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 1rem;display:block;"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            <p style="font-size:1.125rem;font-weight:600;color:#0d2b6e;margin:0 0 .5rem;">No opportunities found</p>
            <p style="color:#8d98a1;font-size:.875rem;">Try adjusting your filters</p>
        </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.5rem;">
            @foreach($opportunities as $opp)
            @php $sc=$sectorColors[$opp->sector]??'#1a3c8f'; @endphp
            <a href="{{ route('startups.show',$opp->slug) }}" style="text-decoration:none;background:#fff;border:1px solid #dde3ea;border-radius:1.25rem;overflow:hidden;display:flex;flex-direction:column;transition:all .25s;box-shadow:0 2px 8px rgba(0,0,0,.04);" onmouseover="this.style.boxShadow='0 16px 40px rgba(26,60,143,.14)';this.style.transform='translateY(-4px)';this.style.borderColor='#bfdbfe';" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,.04)';this.style.transform='translateY(0)';this.style.borderColor='#dde3ea';">
                {{-- Color bar --}}
                <div style="height:4px;background:linear-gradient(to right,{{ $sc }},{{ $sc }}99);"></div>
                <div style="padding:1.5rem;flex:1;display:flex;flex-direction:column;">
                    {{-- Header --}}
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1rem;">
                        <div style="width:3rem;height:3rem;border-radius:.875rem;background:{{ $sc }}18;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span style="color:{{ $sc }};font-weight:800;font-size:1rem;">{{ strtoupper(substr($opp->title,0,2)) }}</span>
                        </div>
                        <div style="display:flex;gap:.375rem;flex-wrap:wrap;justify-content:flex-end;">
                            @if($opp->is_hot_deal)<span style="font-size:.65rem;background:#fff7ed;color:#f97316;font-weight:700;padding:.2rem .55rem;border-radius:9999px;border:1px solid #fed7aa;">🔥 Hot</span>@endif
                            @if($opp->is_featured)<span style="font-size:.65rem;background:#eff6ff;color:#1a3c8f;font-weight:700;padding:.2rem .55rem;border-radius:9999px;border:1px solid #bfdbfe;">⭐ Featured</span>@endif
                        </div>
                    </div>
                    {{-- Title --}}
                    <h3 style="font-weight:700;color:#0d2b6e;font-size:1.0625rem;margin:0 0 .5rem;line-height:1.4;">{{ $opp->title }}</h3>
                    {{-- Tags --}}
                    <div style="display:flex;flex-wrap:wrap;gap:.375rem;margin-bottom:.875rem;">
                        @if($opp->sector)<span style="font-size:.68rem;font-weight:600;padding:.2rem .6rem;border-radius:9999px;background:{{ $sc }}18;color:{{ $sc }};">{{ $opp->sector }}</span>@endif
                        @if($opp->stage)<span style="font-size:.68rem;background:#f1f5f9;color:#475569;padding:.2rem .6rem;border-radius:9999px;">{{ $opp->stage }}</span>@endif
                        @if($opp->location)<span style="font-size:.68rem;color:#8d98a1;">📍 {{ $opp->location }}</span>@endif
                    </div>
                    {{-- Description --}}
                    <p style="font-size:.8125rem;color:#8d98a1;line-height:1.6;flex:1;margin:0 0 1.25rem;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $opp->business_problem }}</p>
                    {{-- Footer --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;padding-top:1rem;border-top:1px solid #f1f5f9;">
                        @if($opp->ask_amount)
                        <div>
                            <p style="font-size:.65rem;color:#8d98a1;margin:0 0 .125rem;text-transform:uppercase;letter-spacing:.05em;">Investment Ask</p>
                            <p style="font-weight:800;color:#0d2b6e;font-size:1.0625rem;margin:0;">৳{{ number_format($opp->ask_amount) }}</p>
                        </div>
                        @else<span></span>@endif
                        <span style="background:#f97316;color:#fff;font-size:.75rem;font-weight:700;padding:.375rem .875rem;border-radius:.5rem;">Invest Now →</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div style="margin-top:2.5rem;">{{ $opportunities->withQueryString()->links() }}</div>
        @endif
    </div>
</section>

{{-- Why Invest --}}
<section style="background:#fff;padding:5rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3rem;">
            <span style="display:inline-block;background:#eff6ff;border:1px solid #bfdbfe;color:#1a3c8f;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:.875rem;text-transform:uppercase;letter-spacing:.08em;">Why VentureMatch</span>
            <h2 style="font-size:2.25rem;font-weight:800;color:#0d2b6e;margin:.75rem 0 0;letter-spacing:-.02em;">The Smarter Way to Invest</h2>
        </div>
        @php $reasons=[
            ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','title'=>'Verified Opportunities','desc'=>'Every startup is reviewed and approved by our team before going live.','c'=>'#1a3c8f','bg'=>'#eff6ff'],
            ['icon'=>'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6','title'=>'High-Growth Sectors','desc'=>'FinTech, AgriTech, HealthTech and more — curated for maximum potential.','c'=>'#f97316','bg'=>'#fff7ed'],
            ['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','title'=>'Direct Founder Access','desc'=>'Connect directly with founders — no middlemen, no delays.','c'=>'#16a34a','bg'=>'#f0fdf4'],
            ['icon'=>'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z','title'=>'Secure & Transparent','desc'=>'Full visibility into deal terms, traction, and use of funds.','c'=>'#8b5cf6','bg'=>'#faf5ff'],
        ]; @endphp
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.25rem;">
            @foreach($reasons as $r)
            <div style="background:#f4f7fb;border:1px solid #dde3ea;border-radius:1rem;padding:1.75rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                <div style="width:3rem;height:3rem;background:{{ $r['bg'] }};border-radius:.75rem;display:flex;align-items:center;justify-content:center;margin-bottom:1.25rem;">
                    <svg width="20" height="20" fill="none" stroke="{{ $r['c'] }}" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $r['icon'] }}"/></svg>
                </div>
                <h4 style="font-size:1rem;font-weight:700;color:#0d2b6e;margin:0 0 .5rem;">{{ $r['title'] }}</h4>
                <p style="font-size:.8125rem;color:#8d98a1;line-height:1.6;margin:0;">{{ $r['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);padding:5rem 1.5rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-4rem;right:-4rem;width:20rem;height:20rem;background:rgba(249,115,22,.12);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:48rem;margin:0 auto;position:relative;">
        <h2 style="font-size:2.5rem;font-weight:800;color:#fff;margin:0 0 1rem;letter-spacing:-.02em;">Ready to Start Investing?</h2>
        <p style="color:rgba(255,255,255,.75);font-size:1.125rem;margin:0 0 2.5rem;line-height:1.6;">Join hundreds of investors already deploying capital through VentureMatch.</p>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem;">
            <a href="{{ route('register.investor') }}" style="background:#f97316;color:#fff;font-weight:700;padding:1rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;">Join as Investor →</a>
            <a href="{{ route('register.seeker') }}" style="background:rgba(255,255,255,.15);color:#fff;font-weight:600;padding:1rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;border:1px solid rgba(255,255,255,.3);">Submit Your Startup →</a>
        </div>
    </div>
</section>

@endsection
