@extends('layouts.app')
@section('title', 'Top Startups')

@section('content')

{{-- Hero --}}
<div style="background:linear-gradient(135deg,#0d0a04,#1a1208,#241c0a);padding:5rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-5rem;right:-5rem;width:25rem;height:25rem;background:rgba(212,146,15,.07);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(212,146,15,.1);border:1px solid rgba(212,146,15,.25);color:rgba(212,146,15,.8);font-size:.75rem;font-weight:600;padding:.375rem 1rem;border-radius:9999px;margin-bottom:1.5rem;">
            <span style="width:.375rem;height:.375rem;background:#f59e0b;border-radius:50%;display:inline-block;"></span>
            Investment Opportunities
        </span>
        <h1 style="font-size:clamp(2.5rem,6vw,3.75rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;color:#fff;letter-spacing:-.03em;">
            Top <span style="color:#d4920f;">Startups</span>
        </h1>
        <p style="font-size:1.125rem;color:rgba(212,146,15,.6);max-width:32rem;line-height:1.7;margin:0;">
            Discover high-potential startups seeking investment. Browse, explore, and connect with founders.
        </p>
    </div>
</div>

{{-- Sector Filter Pills --}}
<div style="background:#110e05;border-bottom:1px solid rgba(212,146,15,.1);padding:1rem 1.5rem;overflow-x:auto;">
    <div style="max-width:80rem;margin:0 auto;display:flex;gap:.625rem;flex-wrap:nowrap;min-width:max-content;">
        @php $allSectors = ['All'] + $sectors->toArray(); @endphp
        @foreach($allSectors as $s)
        <a href="{{ $s==='All' ? route('startups.index') : route('startups.index',['sector'=>$s]) }}"
           style="padding:.4rem 1rem;border-radius:.625rem;font-size:.78rem;font-weight:600;text-decoration:none;white-space:nowrap;{{ (request('sector')===$s||($s==='All'&&!request('sector'))) ? 'background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;' : 'background:rgba(255,255,255,.05);color:rgba(255,255,255,.6);border:1px solid rgba(212,146,15,.15);' }}">
            {{ $s }}
        </a>
        @endforeach
    </div>
</div>

{{-- Main Content --}}
<div style="background:#0d0a04;padding:3rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">

        {{-- Filters --}}
        <form method="GET" style="background:#1a1408;border:1px solid rgba(212,146,15,.15);border-radius:1rem;padding:1.25rem;margin-bottom:2rem;display:flex;flex-wrap:wrap;gap:.875rem;align-items:flex-end;">
            <div style="flex:1;min-width:200px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:rgba(212,146,15,.6);margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search startups..."
                    style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;box-sizing:border-box;">
            </div>
            <div style="min-width:150px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:rgba(212,146,15,.6);margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Sector</label>
                <select name="sector" style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#c9b48a;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Sectors</option>
                    @foreach($sectors as $s)
                    <option value="{{ $s }}" {{ request('sector')===$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:150px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:rgba(212,146,15,.6);margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Stage</label>
                <select name="stage" style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#c9b48a;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Stages</option>
                    @foreach($stages as $s)
                    <option value="{{ $s }}" {{ request('stage')===$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.5rem 1.25rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;">Filter</button>
            @if(request()->hasAny(['search','sector','stage']))
            <a href="{{ route('startups.index') }}" style="font-size:.875rem;color:rgba(212,146,15,.5);text-decoration:none;padding:.5rem 0;">✕ Clear</a>
            @endif
        </form>

        <p style="font-size:.875rem;color:#6b5c3e;margin-bottom:1.5rem;">{{ $opportunities->total() }} startup{{ $opportunities->total()!=1?'s':'' }} found</p>

        @if($opportunities->isEmpty())
        <div style="text-align:center;padding:5rem 0;color:#6b5c3e;">
            <svg width="64" height="64" fill="none" stroke="rgba(212,146,15,.2)" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 1rem;display:block;"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            <p style="font-size:1.125rem;font-weight:500;color:#9a8a6a;">No startups found</p>
        </div>
        @else
        @php $sectorColors=['FinTech'=>'#3b82f6','AgriTech'=>'#10b981','HealthTech'=>'#ef4444','EdTech'=>'#f59e0b','CleanTech'=>'#8b5cf6']; @endphp
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.25rem;">
            @foreach($opportunities as $opp)
            @php $sc = $sectorColors[$opp->sector] ?? '#d4920f'; @endphp
            <a href="{{ route('startups.show', $opp->slug) }}" style="text-decoration:none;background:#1a1408;border:1px solid rgba(212,146,15,.12);border-radius:1.25rem;padding:1.5rem;display:flex;flex-direction:column;transition:all .25s;position:relative;overflow:hidden;" onmouseover="this.style.boxShadow='0 12px 30px rgba(0,0,0,.4)';this.style.transform='translateY(-3px)';this.style.borderColor='rgba(212,146,15,.35)';" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)';this.style.borderColor='rgba(212,146,15,.12)';">
                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:{{ $sc }};"></div>
                <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1rem;">
                    <div style="width:3rem;height:3rem;background:{{ $sc }}20;border-radius:.875rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <span style="color:{{ $sc }};font-weight:800;font-size:1rem;">{{ strtoupper(substr($opp->title,0,2)) }}</span>
                    </div>
                    <div style="display:flex;gap:.375rem;flex-wrap:wrap;justify-content:flex-end;">
                        @if($opp->is_featured)<span style="font-size:.65rem;background:rgba(245,158,11,.15);color:#f59e0b;font-weight:700;padding:.2rem .5rem;border-radius:9999px;">⭐ Featured</span>@endif
                        @if($opp->is_hot_deal)<span style="font-size:.65rem;background:rgba(239,68,68,.15);color:#f87171;font-weight:700;padding:.2rem .5rem;border-radius:9999px;">🔥 Hot</span>@endif
                    </div>
                </div>
                <h3 style="font-weight:700;color:#f0e6c8;font-size:1rem;margin:0 0 .625rem;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $opp->title }}</h3>
                <div style="display:flex;flex-wrap:wrap;gap:.375rem;margin-bottom:.875rem;">
                    @if($opp->sector)<span style="font-size:.68rem;font-weight:600;padding:.2rem .55rem;border-radius:9999px;background:{{ $sc }}18;color:{{ $sc }};">{{ $opp->sector }}</span>@endif
                    @if($opp->stage)<span style="font-size:.68rem;background:rgba(255,255,255,.06);color:#7a6a4a;padding:.2rem .55rem;border-radius:9999px;">{{ $opp->stage }}</span>@endif
                    @if($opp->location)<span style="font-size:.68rem;color:#6b5c3e;">📍 {{ $opp->location }}</span>@endif
                </div>
                <p style="font-size:.8125rem;color:#7a6a4a;line-height:1.55;flex:1;margin:0 0 1rem;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $opp->business_problem }}</p>
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:.875rem;border-top:1px solid rgba(212,146,15,.08);">
                    @if($opp->ask_amount)
                    <div>
                        <p style="font-size:.68rem;color:#6b5c3e;margin:0 0 .125rem;">Seeking</p>
                        <p style="font-weight:800;color:#d4920f;font-size:.9375rem;margin:0;">৳{{ number_format($opp->ask_amount) }}</p>
                    </div>
                    @else<span></span>@endif
                    <span style="font-size:.78rem;color:#d4920f;font-weight:600;">View Details →</span>
                </div>
            </a>
            @endforeach
        </div>

        <div style="margin-top:2.5rem;">{{ $opportunities->withQueryString()->links() }}</div>
        @endif
    </div>
</div>

{{-- CTA --}}
<div style="background:linear-gradient(135deg,#1a1208,#241c0a);padding:4rem 1.5rem;text-align:center;">
    <div style="max-width:40rem;margin:0 auto;">
        <h2 style="font-size:2rem;font-weight:800;color:#fff;margin:0 0 .75rem;">Have a Startup to Fund?</h2>
        <p style="color:rgba(212,146,15,.55);font-size:1rem;margin:0 0 2rem;line-height:1.6;">Submit your startup and get discovered by 500+ verified investors on VentureMatch.</p>
        <a href="{{ route('register.seeker') }}" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:1rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;display:inline-block;">Submit Your Startup →</a>
    </div>
</div>

@endsection
