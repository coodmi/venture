@extends('layouts.app')
@section('title', 'Investors — Investment Opportunities')

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
        @php
        $coverGradients=[
            'FinTech'    =>'linear-gradient(135deg,#1a3c8f 0%,#2563eb 100%)',
            'AgriTech'   =>'linear-gradient(135deg,#14532d 0%,#16a34a 100%)',
            'HealthTech' =>'linear-gradient(135deg,#991b1b 0%,#ef4444 100%)',
            'EdTech'     =>'linear-gradient(135deg,#c2410c 0%,#f97316 100%)',
            'CleanTech'  =>'linear-gradient(135deg,#5b21b6 0%,#8b5cf6 100%)',
            'E-Commerce' =>'linear-gradient(135deg,#0e7490 0%,#06b6d4 100%)',
            'FoodTech'   =>'linear-gradient(135deg,#b45309 0%,#f59e0b 100%)',
            'LogiTech'   =>'linear-gradient(135deg,#3730a3 0%,#6366f1 100%)',
        ];
        $icons=[
            'FinTech'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            'AgriTech'=>'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064',
            'HealthTech'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
            'EdTech'=>'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z',
            'CleanTech'=>'M13 10V3L4 14h7v7l9-11h-7z',
        ];
        @endphp
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;">
            @foreach($opportunities as $opp)
            @php
                $sc  = $sectorColors[$opp->sector] ?? '#1a3c8f';
                $grad= $coverGradients[$opp->sector] ?? 'linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 100%)';
                $ico = $icons[$opp->sector] ?? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6';
            @endphp
            <a href="{{ route('investment.show',$opp->slug) }}"
               style="text-decoration:none;border-radius:1.25rem;overflow:hidden;display:flex;flex-direction:column;transition:all .3s;box-shadow:0 4px 16px rgba(0,0,0,.1);position:relative;aspect-ratio:3/4;min-height:340px;"
               onmouseover="this.style.boxShadow='0 20px 50px rgba(0,0,0,.2)';this.style.transform='translateY(-5px)';"
               onmouseout="this.style.boxShadow='0 4px 16px rgba(0,0,0,.1)';this.style.transform='translateY(0)';">

                {{-- Full background --}}
                @if(!empty($opp->company_logo))
                    <img src="{{ Storage::url($opp->company_logo) }}" alt="{{ $opp->title }}"
                         style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;z-index:0;">
                @else
                    <div style="position:absolute;inset:0;background:{{ $grad }};z-index:0;">
                        <div style="position:absolute;inset:0;opacity:.08;background-image:radial-gradient(circle at 20% 50%,#fff 1px,transparent 1px),radial-gradient(circle at 80% 20%,#fff 1px,transparent 1px);background-size:30px 30px;"></div>
                        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                            <div style="width:5rem;height:5rem;border-radius:1.25rem;background:rgba(255,255,255,.15);border:2px solid rgba(255,255,255,.3);display:flex;align-items:center;justify-content:center;">
                                <span style="color:#fff;font-weight:800;font-size:1.5rem;">{{ strtoupper(substr($opp->title,0,2)) }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Dark gradient overlay --}}
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(5,10,30,.95) 0%,rgba(5,10,30,.5) 45%,transparent 75%);z-index:1;"></div>

                {{-- Badges top --}}
                <div style="position:absolute;top:.75rem;left:.75rem;display:flex;gap:.375rem;z-index:2;">
                    @if($opp->is_hot_deal)<span style="background:rgba(249,115,22,.9);color:#fff;font-size:.62rem;font-weight:700;padding:.2rem .6rem;border-radius:9999px;">🔥 Hot Deal</span>@endif
                    @if($opp->is_featured)<span style="background:rgba(255,255,255,.15);color:#fff;font-size:.62rem;font-weight:700;padding:.2rem .6rem;border-radius:9999px;border:1px solid rgba(255,255,255,.25);backdrop-filter:blur(4px);">⭐ Featured</span>@endif
                </div>

                {{-- Text overlay at bottom --}}
                <div style="position:absolute;bottom:0;left:0;right:0;padding:1.5rem 1.25rem 1.25rem;z-index:2;">
                    <div style="display:flex;flex-wrap:wrap;gap:.3rem;margin-bottom:.5rem;">
                        @if($opp->sector)<span style="font-size:.62rem;font-weight:600;padding:.15rem .5rem;border-radius:9999px;background:rgba(255,255,255,.15);color:#fff;border:1px solid rgba(255,255,255,.2);">{{ $opp->sector }}</span>@endif
                        @if($opp->stage)<span style="font-size:.62rem;padding:.15rem .5rem;border-radius:9999px;background:rgba(255,255,255,.1);color:rgba(255,255,255,.75);">{{ $opp->stage }}</span>@endif
                    </div>
                    <p style="font-size:1.0625rem;font-weight:700;color:#fff;margin:0 0 .25rem;line-height:1.3;">{{ $opp->title }}</p>
                    @if($opp->location)<p style="font-size:.72rem;color:rgba(255,255,255,.55);margin:0 0 .875rem;">📍 {{ $opp->location }}</p>@else<div style="margin-bottom:.875rem;"></div>@endif
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        @if($opp->ask_amount)
                        <div>
                            <p style="font-size:.6rem;color:rgba(255,255,255,.5);margin:0 0 .1rem;text-transform:uppercase;letter-spacing:.06em;font-weight:600;">Investment Ask</p>
                            <p style="font-weight:800;color:#fb923c;font-size:1.0625rem;margin:0;">৳{{ number_format($opp->ask_amount) }}</p>
                        </div>
                        @else<span></span>@endif
                        <span style="background:linear-gradient(135deg,#f97316,#fb923c);color:#fff;font-size:.75rem;font-weight:700;padding:.45rem 1rem;border-radius:.625rem;box-shadow:0 4px 12px rgba(249,115,22,.4);">Invest Now →</span>
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
