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
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.25rem;">
            @foreach($opportunities as $opp)
            @php $sc=$sectorColors[$opp->sector]??'#1a3c8f'; $grad=$coverGrads[$opp->sector]??'linear-gradient(135deg,#0d2b6e,#2563eb)'; @endphp
            <a href="{{ route('startups.show',$opp->slug) }}"
               style="text-decoration:none;border-radius:1rem;overflow:hidden;display:flex;flex-direction:column;transition:all .25s;box-shadow:0 2px 12px rgba(0,0,0,.07);background:#fff;border:1px solid #e8ecf0;"
               onmouseover="this.style.boxShadow='0 12px 32px rgba(0,0,0,.13)';this.style.transform='translateY(-3px)';"
               onmouseout="this.style.boxShadow='0 2px 12px rgba(0,0,0,.07)';this.style.transform='translateY(0)';">

                {{-- Logo area --}}
                <div style="width:100%;height:11rem;position:relative;overflow:hidden;background:#f4f6f8;display:flex;align-items:center;justify-content:center;">
                    @if(!empty($opp->company_logo))
                        <img src="{{ Storage::url($opp->company_logo) }}" alt="{{ $opp->title }}"
                             style="width:100%;height:100%;object-fit:contain;padding:1.25rem;">
                    @else
                        <div style="width:5rem;height:5rem;border-radius:1.25rem;background:{{ $grad }};display:flex;align-items:center;justify-content:center;box-shadow:0 4px 16px rgba(0,0,0,.15);">
                            <span style="color:#fff;font-weight:800;font-size:1.5rem;">{{ strtoupper(substr($opp->title,0,2)) }}</span>
                        </div>
                    @endif
                    @if($opp->ask_amount)
                    <div style="position:absolute;top:.625rem;left:.625rem;background:#16a34a;color:#fff;font-size:.65rem;font-weight:700;padding:.25rem .625rem;border-radius:.375rem;">৳{{ number_format($opp->ask_amount/100000,0) }}L raised</div>
                    @endif
                    @if($opp->stage)
                    <div style="position:absolute;top:.625rem;right:.625rem;background:#fff;color:#374151;font-size:.65rem;font-weight:700;padding:.25rem .625rem;border-radius:.375rem;border:1px solid #e5e7eb;letter-spacing:.05em;text-transform:uppercase;">{{ $opp->stage }}</div>
                    @endif
                </div>

                {{-- Info --}}
                <div style="padding:1rem 1.125rem 1.125rem;border-top:1px solid #f0f2f5;">
                    @if($opp->sector)<p style="font-size:.65rem;font-weight:700;color:{{ $sc }};margin:0 0 .375rem;text-transform:uppercase;letter-spacing:.08em;">{{ $opp->sector }}</p>@endif
                    <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 .375rem;line-height:1.3;">{{ $opp->title }}</h3>
                    <p style="font-size:.8125rem;color:#6b7280;line-height:1.55;margin:0 0 .875rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $opp->business_problem }}</p>
                    <div style="display:flex;align-items:center;gap:1rem;padding-top:.75rem;border-top:1px solid #f0f2f5;font-size:.72rem;color:#9ca3af;">
                        @if($opp->location)<span style="display:flex;align-items:center;gap:.25rem;"><svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>{{ $opp->location }}</span>@endif
                        @if($opp->user?->name)<span style="display:flex;align-items:center;gap:.25rem;"><svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>{{ explode(' ',$opp->user->name)[0] }}</span>@endif
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
