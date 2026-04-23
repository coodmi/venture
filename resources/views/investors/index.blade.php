@extends('layouts.app')
@section('title', 'Investors')

@section('content')
@php
    $typeLabel=['angel'=>'Angel','vc'=>'Venture Capital','corporate'=>'Corporate','family_office'=>'Family Office','impact'=>'Impact'];
    $stageLabel=['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
    $typeColor=['angel'=>'#f97316','vc'=>'#1a3c8f','corporate'=>'#6366f1','family_office'=>'#a855f7','impact'=>'#16a34a'];
    $typeBg=['angel'=>'background:#fff7ed;color:#f97316;','vc'=>'background:#eff6ff;color:#1a3c8f;','corporate'=>'background:#eef2ff;color:#4f46e5;','family_office'=>'background:#faf5ff;color:#7c3aed;','impact'=>'background:#f0fdf4;color:#16a34a;'];
    $total = array_sum(array_values($counts ?? []));
@endphp

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);color:#fff;padding:5rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-5rem;right:-5rem;width:25rem;height:25rem;background:rgba(249,115,22,.15);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-block;background:rgba(249,115,22,.2);border:1px solid rgba(249,115,22,.4);color:#fed7aa;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:1.5rem;text-transform:uppercase;letter-spacing:.08em;">Investment Community</span>
        <h1 style="font-size:clamp(2.5rem,6vw,3.75rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;letter-spacing:-.03em;max-width:36rem;">
            Meet Our <span style="color:#fb923c;">Investors</span>
        </h1>
        <p style="font-size:1.125rem;color:rgba(255,255,255,.8);max-width:36rem;line-height:1.7;margin:0 0 2rem;">
            Connect with {{ $total }}+ verified investors actively seeking opportunities.
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
            <a href="{{ route('register.investor') }}" style="background:#f97316;color:#fff;font-weight:700;padding:.75rem 1.75rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;">Join as Investor</a>
            <a href="{{ route('register.seeker') }}" style="background:rgba(255,255,255,.15);color:#fff;font-weight:600;padding:.75rem 1.75rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;border:1px solid rgba(255,255,255,.3);">Submit Your Startup</a>
        </div>
    </div>
</section>

{{-- Type Stats Bar --}}
<div style="background:#fff;border-bottom:1px solid #dde3ea;overflow-x:auto;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;display:flex;min-width:max-content;">
        @foreach($types as $key => $label)
        @php $active=request('type')===$key; $col=$typeColor[$key]??'#1a3c8f'; @endphp
        <a href="{{ route('investors.index',['type'=>$key]) }}"
           style="display:flex;flex-direction:column;align-items:center;padding:1.25rem 2rem;text-decoration:none;border-bottom:3px solid {{ $active?$col:'transparent' }};background:{{ $active?'#f8fafc':'transparent' }};transition:all .2s;white-space:nowrap;">
            <span style="font-size:1.5rem;font-weight:800;color:#0d2b6e;line-height:1;">{{ $counts[$key]??0 }}</span>
            <span style="font-size:.7rem;color:#8d98a1;margin-top:.25rem;font-weight:500;">{{ $typeLabel[$key]??$label }}</span>
        </a>
        @endforeach
        <a href="{{ route('investors.index') }}" style="display:flex;flex-direction:column;align-items:center;padding:1.25rem 2rem;text-decoration:none;border-bottom:3px solid {{ !request('type')?'#1a3c8f':'transparent' }};background:{{ !request('type')?'#f8fafc':'transparent' }};transition:all .2s;white-space:nowrap;">
            <span style="font-size:1.5rem;font-weight:800;color:#0d2b6e;line-height:1;">{{ $total }}</span>
            <span style="font-size:.7rem;color:#8d98a1;margin-top:.25rem;font-weight:500;">All</span>
        </a>
    </div>
</div>

{{-- Content --}}
<section style="background:#f4f7fb;padding:3rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">

        {{-- Filters --}}
        <form method="GET" style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.25rem;margin-bottom:2rem;display:flex;flex-wrap:wrap;gap:.875rem;align-items:flex-end;box-shadow:0 2px 8px rgba(0,0,0,.04);">
            <div style="flex:1;min-width:180px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or organization..."
                    style="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;box-sizing:border-box;">
            </div>
            <div style="min-width:150px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Type</label>
                <select name="type" style="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Types</option>
                    @foreach($types as $k=>$v)
                    <option value="{{ $k }}" {{ request('type')===$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:150px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Stage</label>
                <select name="stage" style="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Stages</option>
                    @foreach($stages as $k=>$v)
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
        <div style="text-align:center;padding:5rem 0;">
            <svg width="64" height="64" fill="none" stroke="#bfdbfe" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 1rem;display:block;"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <p style="font-size:1.125rem;font-weight:500;color:#8d98a1;">No investors found</p>
        </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:1.25rem;">
            @foreach($investors as $inv)
            @php $ic=$typeColor[$inv->investor_type]??'#1a3c8f'; @endphp
            <a href="{{ route('investors.show',$inv->id) }}" style="text-decoration:none;background:#fff;border:1px solid #dde3ea;border-radius:1.25rem;padding:1.5rem;display:flex;flex-direction:column;transition:all .25s;overflow:hidden;position:relative;box-shadow:0 2px 8px rgba(0,0,0,.04);" onmouseover="this.style.boxShadow='0 12px 30px rgba(26,60,143,.12)';this.style.transform='translateY(-3px)';this.style.borderColor='#bfdbfe';" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,.04)';this.style.transform='translateY(0)';this.style.borderColor='#dde3ea';">
                <div style="position:absolute;top:0;left:0;right:0;height:4px;background:{{ $ic }};"></div>
                <div style="display:flex;align-items:flex-start;gap:.875rem;margin-bottom:1rem;">
                    <div style="width:3rem;height:3rem;border-radius:.875rem;background:{{ $ic }};display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:800;font-size:1rem;color:#fff;">
                        {{ strtoupper(substr($inv->user->name??'IN',0,2)) }}
                    </div>
                    <div style="flex:1;min-width:0;">
                        <span style="font-size:.9375rem;font-weight:700;color:#0d2b6e;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block;">{{ $inv->user->name??'—' }}</span>
                        <p style="font-size:.75rem;color:#8d98a1;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inv->designation }}</p>
                        <p style="font-size:.7rem;color:#8d98a1;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inv->organization }}</p>
                    </div>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:.375rem;margin-bottom:.875rem;">
                    <span style="font-size:.68rem;font-weight:600;padding:.2rem .6rem;border-radius:9999px;{{ $typeBg[$inv->investor_type]??'background:#f1f5f9;color:#475569;' }}">{{ $typeLabel[$inv->investor_type]??$inv->investor_type }}</span>
                    @if($inv->investment_stage)<span style="font-size:.68rem;background:#f1f5f9;color:#475569;padding:.2rem .6rem;border-radius:9999px;">{{ $stageLabel[$inv->investment_stage]??$inv->investment_stage }}</span>@endif
                </div>
                @if($inv->bio)<p style="font-size:.78rem;color:#8d98a1;line-height:1.5;margin:0 0 .875rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;flex:1;">{{ $inv->bio }}</p>@endif
                @if(!empty($inv->sector_preferences))
                <div style="display:flex;flex-wrap:wrap;gap:.3rem;margin-bottom:.875rem;">
                    @foreach(array_slice((array)$inv->sector_preferences,0,3) as $sec)
                    <span style="font-size:.65rem;background:#eff6ff;color:#1a3c8f;padding:.15rem .5rem;border-radius:9999px;">{{ $sec }}</span>
                    @endforeach
                </div>
                @endif
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:.75rem;border-top:1px solid #f1f5f9;margin-top:auto;">
                    @if($inv->ticket_size_min && $inv->ticket_size_max)
                    <span style="font-size:.75rem;font-weight:700;color:#1a3c8f;">৳{{ number_format($inv->ticket_size_min/100000,0) }}L–{{ number_format($inv->ticket_size_max/100000,0) }}L</span>
                    @else<span></span>@endif
                    <span style="font-size:.75rem;color:#f97316;font-weight:600;">View →</span>
                </div>
            </a>
            @endforeach
        </div>
        <div style="margin-top:2.5rem;">{{ $investors->withQueryString()->links() }}</div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);padding:4rem 1.5rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-4rem;right:-4rem;width:20rem;height:20rem;background:rgba(249,115,22,.12);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:40rem;margin:0 auto;position:relative;">
        <h2 style="font-size:2rem;font-weight:800;color:#fff;margin:0 0 .75rem;">Looking to Raise Capital?</h2>
        <p style="color:rgba(255,255,255,.75);font-size:1rem;margin:0 0 2rem;line-height:1.6;">Submit your startup and get discovered by our verified investor network.</p>
        <a href="{{ route('register.seeker') }}" style="background:#f97316;color:#fff;font-weight:700;padding:1rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;display:inline-block;">Submit Your Startup →</a>
    </div>
</section>

@endsection
