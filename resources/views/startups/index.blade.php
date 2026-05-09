@extends('layouts.app')
@section('title', 'Top Startups')

@section('content')

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);color:#fff;padding:5rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-5rem;right:-5rem;width:25rem;height:25rem;background:rgba(249,115,22,.15);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-block;background:rgba(249,115,22,.2);border:1px solid rgba(249,115,22,.4);color:#fed7aa;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:1.5rem;text-transform:uppercase;letter-spacing:.08em;">Investment Opportunities</span>
        <h1 style="font-size:clamp(2.5rem,6vw,3.75rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;letter-spacing:-.03em;max-width:36rem;">
            Top <span style="color:#fb923c;">Startups</span>
        </h1>
        <p style="font-size:1.125rem;color:rgba(255,255,255,.8);max-width:32rem;line-height:1.7;margin:0;">
            Discover high-potential startups seeking investment. Browse, explore, and connect with founders.
        </p>
    </div>
</section>

{{-- Sector Filter Pills --}}
<div style="background:#fff;border-bottom:1px solid #dde3ea;padding:1rem 1.5rem;overflow-x:auto;">
    <div style="max-width:80rem;margin:0 auto;display:flex;gap:.625rem;flex-wrap:nowrap;min-width:max-content;">
        @php $allSectors = ['All'] + $sectors->toArray(); @endphp
        @foreach($allSectors as $s)
        <a href="{{ $s==='All' ? route('startups.index') : route('startups.index',['sector'=>$s]) }}"
           style="padding:.4rem 1rem;border-radius:.625rem;font-size:.78rem;font-weight:600;text-decoration:none;white-space:nowrap;{{ (request('sector')===$s||($s==='All'&&!request('sector'))) ? 'background:#1a3c8f;color:#fff;' : 'background:#f4f7fb;color:#374151;border:1px solid #dde3ea;' }}">
            {{ $s }}
        </a>
        @endforeach
    </div>
</div>

{{-- Main Content --}}
<section style="background:#f4f7fb;padding:3rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">

        {{-- Filters --}}
        <form method="GET" style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.25rem;margin-bottom:2rem;display:flex;flex-wrap:wrap;gap:.875rem;align-items:flex-end;box-shadow:0 2px 8px rgba(0,0,0,.04);">
            <div style="flex:1;min-width:200px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search startups..."
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
            @if(request()->hasAny(['search','sector','stage']))
            <a href="{{ route('startups.index') }}" style="font-size:.875rem;color:#8d98a1;text-decoration:none;padding:.5rem 0;">✕ Clear</a>
            @endif
        </form>

        <p style="font-size:.875rem;color:#8d98a1;margin-bottom:1.5rem;">{{ $opportunities->total() }} startup{{ $opportunities->total()!=1?'s':'' }} found</p>

        @if($opportunities->isEmpty())
        <div style="text-align:center;padding:5rem 0;">
            <svg width="64" height="64" fill="none" stroke="#bfdbfe" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 1rem;display:block;"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            <p style="font-size:1.125rem;font-weight:500;color:#8d98a1;">No startups found</p>
        </div>
        @else
        @php
            $sectorColors=['FinTech'=>'#3b82f6','AgriTech'=>'#10b981','HealthTech'=>'#ef4444','EdTech'=>'#f97316','CleanTech'=>'#8b5cf6'];
            $coverGrads=['FinTech'=>'linear-gradient(135deg,#1a3c8f,#2563eb)','AgriTech'=>'linear-gradient(135deg,#14532d,#16a34a)','HealthTech'=>'linear-gradient(135deg,#991b1b,#ef4444)','EdTech'=>'linear-gradient(135deg,#c2410c,#f97316)','CleanTech'=>'linear-gradient(135deg,#5b21b6,#8b5cf6)','E-Commerce'=>'linear-gradient(135deg,#0e7490,#06b6d4)','FoodTech'=>'linear-gradient(135deg,#92400e,#f59e0b)','LogiTech'=>'linear-gradient(135deg,#1e1b4b,#6366f1)'];
        @endphp
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.25rem;">
            @foreach($opportunities as $opp)
            @php $sc=$sectorColors[$opp->sector]??'#1a3c8f'; $grad=$coverGrads[$opp->sector]??'linear-gradient(135deg,#0d2b6e,#2563eb)'; @endphp
            <a href="{{ route('startups.show',$opp->slug) }}"
               style="text-decoration:none;border-radius:1.25rem;overflow:hidden;display:flex;flex-direction:column;transition:all .25s;box-shadow:0 4px 16px rgba(0,0,0,.1);position:relative;aspect-ratio:3/4;min-height:320px;"
               onmouseover="this.style.boxShadow='0 16px 40px rgba(0,0,0,.2)';this.style.transform='translateY(-4px)';"
               onmouseout="this.style.boxShadow='0 4px 16px rgba(0,0,0,.1)';this.style.transform='translateY(0)';">

                {{-- Full background --}}
                @if(!empty($opp->company_logo))
                    <img src="{{ Storage::url($opp->company_logo) }}" alt="{{ $opp->title }}"
                         style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;z-index:0;">
                @else
                    <div style="position:absolute;inset:0;background:{{ $grad }};z-index:0;">
                        <div style="position:absolute;inset:0;opacity:.07;background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:24px 24px;"></div>
                        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                            <div style="width:5rem;height:5rem;border-radius:1.25rem;background:rgba(255,255,255,.15);border:2px solid rgba(255,255,255,.3);display:flex;align-items:center;justify-content:center;">
                                <span style="color:#fff;font-weight:800;font-size:1.5rem;">{{ strtoupper(substr($opp->title,0,2)) }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Dark gradient overlay --}}
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(5,10,30,.92) 0%,rgba(5,10,30,.45) 45%,transparent 75%);z-index:1;"></div>

                {{-- Badges top --}}
                <div style="position:absolute;top:.75rem;left:.75rem;display:flex;gap:.375rem;z-index:2;">
                    @if($opp->is_hot_deal)<span style="background:rgba(249,115,22,.9);color:#fff;font-size:.6rem;font-weight:700;padding:.2rem .55rem;border-radius:9999px;">🔥 Hot</span>@endif
                    @if($opp->is_featured)<span style="background:rgba(255,255,255,.15);color:#fff;font-size:.6rem;font-weight:700;padding:.2rem .55rem;border-radius:9999px;border:1px solid rgba(255,255,255,.25);backdrop-filter:blur(4px);">⭐ Featured</span>@endif
                </div>

                {{-- Text overlay at bottom --}}
                <div style="position:absolute;bottom:0;left:0;right:0;padding:1.25rem 1.125rem 1.125rem;z-index:2;">
                    <div style="display:flex;flex-wrap:wrap;gap:.3rem;margin-bottom:.5rem;">
                        @if($opp->sector)<span style="font-size:.62rem;font-weight:600;padding:.15rem .5rem;border-radius:9999px;background:rgba(255,255,255,.15);color:#fff;border:1px solid rgba(255,255,255,.2);">{{ $opp->sector }}</span>@endif
                        @if($opp->stage)<span style="font-size:.62rem;padding:.15rem .5rem;border-radius:9999px;background:rgba(255,255,255,.1);color:rgba(255,255,255,.75);">{{ $opp->stage }}</span>@endif
                    </div>
                    <p style="font-size:1rem;font-weight:700;color:#fff;margin:0 0 .25rem;line-height:1.3;">{{ $opp->title }}</p>
                    @if($opp->location)<p style="font-size:.72rem;color:rgba(255,255,255,.6);margin:0 0 .625rem;">📍 {{ $opp->location }}</p>@endif
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        @if($opp->ask_amount)<span style="font-size:.9375rem;font-weight:800;color:#fb923c;">৳{{ number_format($opp->ask_amount) }}</span>@else<span></span>@endif
                        <span style="font-size:.72rem;color:rgba(255,255,255,.8);font-weight:600;">View Details →</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div style="margin-top:2.5rem;">{{ $opportunities->withQueryString()->links() }}</div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);padding:4rem 1.5rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-4rem;right:-4rem;width:20rem;height:20rem;background:rgba(249,115,22,.12);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:40rem;margin:0 auto;position:relative;">
        <h2 style="font-size:2rem;font-weight:800;color:#fff;margin:0 0 .75rem;">Have a Startup to Fund?</h2>
        <p style="color:rgba(255,255,255,.75);font-size:1rem;margin:0 0 2rem;line-height:1.6;">Submit your startup and get discovered by 500+ verified investors on VentureMatch.</p>
        <a href="{{ route('register.seeker') }}" style="background:#f97316;color:#fff;font-weight:700;padding:1rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;display:inline-block;">Submit Your Startup →</a>
    </div>
</section>

@endsection
