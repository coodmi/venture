@extends('layouts.app')
@section('title', 'Top Investors')

@section('content')

@php
    $catColors=['angel'=>'#f97316','vc'=>'#1a3c8f','corporate'=>'#6366f1','family_office'=>'#a855f7','impact'=>'#16a34a'];
    $catSvg=[
        'angel'         => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:1.375rem;height:1.375rem;"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
        'vc'            => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:1.375rem;height:1.375rem;"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>',
        'corporate'     => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:1.375rem;height:1.375rem;"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>',
        'family_office' => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:1.375rem;height:1.375rem;"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
        'impact'        => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:1.375rem;height:1.375rem;"><path d="M12 22V12M12 12C12 7 7 4 3 6M12 12c0-5 5-8 9-6M7 17c1.5-1 3.5-1.5 5-1.5s3.5.5 5 1.5"/></svg>',
    ];
    $typeLabel=['angel'=>'Angel Investor','vc'=>'Venture Capital','corporate'=>'Corporate','family_office'=>'Family Office','impact'=>'Impact Investor'];
    $stageLabel=['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
    $typeBadge=['angel'=>'background:#fff7ed;color:#f97316;border:1px solid #fed7aa;','vc'=>'background:#eff6ff;color:#1a3c8f;border:1px solid #bfdbfe;','corporate'=>'background:#eef2ff;color:#4f46e5;border:1px solid #c7d2fe;','family_office'=>'background:#faf5ff;color:#7c3aed;border:1px solid #ddd6fe;','impact'=>'background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0;'];
@endphp

{{-- Hero --}}
<div style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 60%,#2563eb 100%);padding:5rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-6rem;right:-6rem;width:28rem;height:28rem;background:rgba(249,115,22,.12);border-radius:50%;filter:blur(70px);"></div>
    <div style="position:absolute;bottom:-4rem;left:-4rem;width:20rem;height:20rem;background:rgba(255,255,255,.05);border-radius:50%;filter:blur(50px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(249,115,22,.2);border:1px solid rgba(249,115,22,.4);color:#fed7aa;font-size:.75rem;font-weight:700;padding:.375rem 1rem;border-radius:9999px;margin-bottom:1.5rem;text-transform:uppercase;letter-spacing:.08em;">
            💼 Investment Community
        </span>
        <h1 style="font-size:clamp(2.5rem,6vw,3.75rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;color:#fff;letter-spacing:-.03em;">
            Meet Our <span style="color:#fb923c;">Investors</span>
        </h1>
        <p style="font-size:1.125rem;color:rgba(255,255,255,.8);max-width:36rem;line-height:1.7;margin:0 0 2rem;">
            Connect with {{ array_sum(array_values($counts ?? [])) }}+ verified investors actively seeking opportunities in Bangladesh.
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
            <a href="{{ route('register.investor') }}" style="background:#f97316;color:#fff;font-weight:700;padding:.625rem 1.5rem;border-radius:.625rem;text-decoration:none;font-size:.875rem;">Join as Investor</a>
            <a href="{{ route('register.seeker') }}" style="background:rgba(255,255,255,.15);color:#fff;font-weight:600;padding:.625rem 1.5rem;border-radius:.625rem;text-decoration:none;font-size:.875rem;border:1px solid rgba(255,255,255,.3);">Submit Your Startup</a>
        </div>
    </div>
</div>

{{-- Category Cards --}}
<div style="background:#fff;border-bottom:1px solid #e2e8f0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;display:grid;grid-template-columns:repeat(5,1fr);">
        @foreach($types as $key => $label)
        <a href="{{ route('investors.index', ['type'=>$key]) }}"
           style="display:flex;flex-direction:column;align-items:center;padding:1.5rem 1rem;text-decoration:none;border-bottom:3px solid {{ request('type')===$key ? $catColors[$key] : 'transparent' }};background:{{ request('type')===$key ? '#f8fafc' : 'transparent' }};transition:all .2s;"
           onmouseover="this.style.background='#f8fafc';" onmouseout="this.style.background='{{ request('type')===$key ? '#f8fafc' : 'transparent' }}';">
            <div style="width:3rem;height:3rem;border-radius:50%;background:{{ $catColors[$key] }};display:flex;align-items:center;justify-content:center;margin-bottom:.625rem;box-shadow:0 4px 14px {{ $catColors[$key] }}55;">
                {!! $catSvg[$key] !!}
            </div>
            <span style="font-size:1.5rem;font-weight:800;color:#0d2b6e;line-height:1;">{{ $counts[$key] ?? 0 }}</span>
            <span style="font-size:.7rem;color:#8d98a1;margin-top:.25rem;text-align:center;font-weight:500;">{{ $label }}</span>
        </a>
        @endforeach
    </div>
</div>

{{-- Main Content --}}
<div style="background:#f4f7fb;padding:3rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">

        {{-- Filters --}}
        <form method="GET" style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.25rem;margin-bottom:2rem;display:flex;flex-wrap:wrap;gap:.875rem;align-items:flex-end;box-shadow:0 1px 4px rgba(0,0,0,.04);">
            <div style="flex:1;min-width:200px;">
                <label style="display:block;font-size:.75rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Search</label>
                <div style="position:relative;">
                    <svg style="position:absolute;left:.75rem;top:50%;transform:translateY(-50%);width:1rem;height:1rem;color:#8d98a1;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or organization..."
                        style="width:100%;background:#f8fafc;border:1px solid #dde3ea;color:#0f172a;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem .5rem 2.25rem;outline:none;box-sizing:border-box;">
                </div>
            </div>
            <div style="min-width:160px;">
                <label style="display:block;font-size:.75rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Type</label>
                <select name="type" style="width:100%;background:#f8fafc;border:1px solid #dde3ea;color:#374151;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Types</option>
                    @foreach($types as $k => $v)
                    <option value="{{ $k }}" {{ request('type')===$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:150px;">
                <label style="display:block;font-size:.75rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Stage</label>
                <select name="stage" style="width:100%;background:#f8fafc;border:1px solid #dde3ea;color:#374151;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Stages</option>
                    @foreach($stages as $k => $v)
                    <option value="{{ $k }}" {{ request('stage')===$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="background:#1a3c8f;color:#fff;font-weight:700;padding:.5rem 1.25rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;">Filter</button>
            @if(request()->hasAny(['search','type','stage']))
            <a href="{{ route('investors.index') }}" style="font-size:.875rem;color:#8d98a1;text-decoration:none;padding:.5rem 0;">✕ Clear</a>
            @endif
        </form>

        <p style="font-size:.875rem;color:#8d98a1;margin-bottom:1.5rem;">{{ $investors->total() }} investor{{ $investors->total()!=1?'s':'' }} found</p>

        @if($investors->isEmpty())
        <div style="text-align:center;padding:5rem 0;color:#8d98a1;">
            <svg width="64" height="64" fill="none" stroke="#dde3ea" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 1rem;display:block;"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <p style="font-size:1.125rem;font-weight:500;color:#374151;">No investors found</p>
        </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:1.25rem;">
            @foreach($investors as $inv)
            @php $ic = $catColors[$inv->investor_type] ?? '#1a3c8f'; @endphp
            <a href="{{ route('investors.show', $inv->id) }}" style="text-decoration:none;background:#fff;border:1px solid #dde3ea;border-radius:1.25rem;padding:1.5rem;display:flex;flex-direction:column;transition:all .25s;overflow:hidden;position:relative;box-shadow:0 2px 8px rgba(0,0,0,.04);" onmouseover="this.style.boxShadow='0 12px 30px rgba(26,60,143,.12)';this.style.transform='translateY(-3px)';this.style.borderColor='{{ $ic }}';" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,.04)';this.style.transform='translateY(0)';this.style.borderColor='#dde3ea';">
                <div style="position:absolute;top:0;left:0;right:0;height:4px;background:{{ $ic }};"></div>
                <div style="display:flex;align-items:flex-start;gap:.875rem;margin-bottom:1rem;">
                    <div style="width:3rem;height:3rem;border-radius:.875rem;background:{{ $ic }};display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:800;font-size:1rem;color:#fff;box-shadow:0 4px 10px {{ $ic }}44;">
                        {{ strtoupper(substr($inv->user->name??'IN',0,2)) }}
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="display:flex;align-items:center;gap:.375rem;">
                            <span style="font-size:.9375rem;font-weight:700;color:#0d2b6e;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block;">{{ $inv->user->name }}</span>
                            @if($inv->verification_status==='verified')<svg width="14" height="14" viewBox="0 0 20 20" fill="#1a3c8f" style="flex-shrink:0;"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>@endif
                        </div>
                        <p style="font-size:.75rem;color:#8d98a1;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inv->designation }}</p>
                        <p style="font-size:.7rem;color:#8d98a1;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inv->organization }}</p>
                    </div>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:.375rem;margin-bottom:.875rem;">
                    <span style="font-size:.68rem;font-weight:600;padding:.2rem .6rem;border-radius:9999px;{{ $typeBadge[$inv->investor_type]??'background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;' }}">{{ $typeLabel[$inv->investor_type]??$inv->investor_type }}</span>
                    @if($inv->investment_stage)<span style="font-size:.68rem;background:#f1f5f9;color:#475569;padding:.2rem .6rem;border-radius:9999px;border:1px solid #e2e8f0;">{{ $stageLabel[$inv->investment_stage]??$inv->investment_stage }}</span>@endif
                </div>
                @if($inv->bio)<p style="font-size:.78rem;color:#8d98a1;line-height:1.5;margin:0 0 .875rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;flex:1;">{{ $inv->bio }}</p>@endif
                <div style="padding-top:.75rem;border-top:1px solid #f1f5f9;margin-top:auto;">
                    @if($inv->sector_preferences)
                    <div style="display:flex;flex-wrap:wrap;gap:.3rem;margin-bottom:.5rem;">
                        @foreach(array_slice($inv->sector_preferences,0,3) as $sec)
                        <span style="font-size:.65rem;background:#eff6ff;color:#1a3c8f;padding:.15rem .5rem;border-radius:.375rem;font-weight:500;">{{ $sec }}</span>
                        @endforeach
                    </div>
                    @endif
                    @if($inv->ticket_size_min && $inv->ticket_size_max)
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <span style="font-size:.68rem;color:#8d98a1;">Ticket Size</span>
                        <span style="font-size:.78rem;font-weight:700;color:#1a3c8f;">৳{{ number_format($inv->ticket_size_min/100000,0) }}L–৳{{ number_format($inv->ticket_size_max/100000,0) }}L</span>
                    </div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        <div style="margin-top:2.5rem;">{{ $investors->withQueryString()->links() }}</div>
        @endif
    </div>
</div>

{{-- CTA --}}
<div style="background:linear-gradient(135deg,#0d2b6e,#1a3c8f);padding:4rem 1.5rem;text-align:center;">
    <div style="max-width:40rem;margin:0 auto;">
        <h2 style="font-size:2rem;font-weight:800;color:#fff;margin:0 0 .75rem;">Looking to Raise Capital?</h2>
        <p style="color:rgba(255,255,255,.7);font-size:1rem;margin:0 0 2rem;line-height:1.6;">Submit your startup and get discovered by our verified investor network.</p>
        <a href="{{ route('register.seeker') }}" style="background:#f97316;color:#fff;font-weight:700;padding:1rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;display:inline-block;">Submit Your Startup →</a>
    </div>
</div>

@endsection
