@extends('layouts.app')
@section('title', 'Top Investors')

@section('content')

@php
    $catColors=['angel'=>'#f59e0b','vc'=>'#3b82f6','corporate'=>'#6366f1','family_office'=>'#a855f7','impact'=>'#10b981'];
    $catSvg=[
        'angel'         => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:1.5rem;height:1.5rem;"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
        'vc'            => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:1.5rem;height:1.5rem;"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>',
        'corporate'     => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:1.5rem;height:1.5rem;"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>',
        'family_office' => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:1.5rem;height:1.5rem;"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
        'impact'        => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:1.5rem;height:1.5rem;"><path d="M12 22V12M12 12C12 7 7 4 3 6M12 12c0-5 5-8 9-6M7 17c1.5-1 3.5-1.5 5-1.5s3.5.5 5 1.5"/></svg>',
    ];
    $typeLabel=['angel'=>'Angel Investor','vc'=>'Venture Capital','corporate'=>'Corporate','family_office'=>'Family Office','impact'=>'Impact Investor'];
    $stageLabel=['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
    $typeBadge=['angel'=>'background:rgba(245,158,11,.15);color:#f59e0b;','vc'=>'background:rgba(59,130,246,.15);color:#60a5fa;','corporate'=>'background:rgba(99,102,241,.15);color:#a5b4fc;','family_office'=>'background:rgba(168,85,247,.15);color:#c084fc;','impact'=>'background:rgba(16,185,129,.15);color:#34d399;'];
@endphp

{{-- Hero --}}
<div style="background:linear-gradient(135deg,#0d0a04,#1a1208,#241c0a);padding:5rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-5rem;right:-5rem;width:25rem;height:25rem;background:rgba(212,146,15,.07);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(212,146,15,.1);border:1px solid rgba(212,146,15,.25);color:rgba(212,146,15,.8);font-size:.75rem;font-weight:600;padding:.375rem 1rem;border-radius:9999px;margin-bottom:1.5rem;">
            <span style="width:.375rem;height:.375rem;background:#f59e0b;border-radius:50%;display:inline-block;"></span>
            Investment Community
        </span>
        <h1 style="font-size:clamp(2.5rem,6vw,3.75rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;color:#fff;letter-spacing:-.03em;">
            Meet Our <span style="color:#d4920f;">Investors</span>
        </h1>
        <p style="font-size:1.125rem;color:rgba(212,146,15,.6);max-width:32rem;line-height:1.7;margin:0;">
            Connect with {{ array_sum($counts) }}+ verified investors actively seeking opportunities in Bangladesh.
        </p>
    </div>
</div>

{{-- Category Stats Bar --}}
<div style="background:#110e05;border-bottom:1px solid rgba(212,146,15,.1);">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;display:grid;grid-template-columns:repeat(5,1fr);">
        @foreach($types as $key => $label)
        <a href="{{ route('investors.index', ['type'=>$key]) }}"
           style="display:flex;flex-direction:column;align-items:center;padding:1.75rem 1rem;text-decoration:none;border-bottom:3px solid {{ request('type')===$key ? $catColors[$key] : 'transparent' }};transition:all .2s;background:{{ request('type')===$key ? 'rgba(212,146,15,.05)' : 'transparent' }};">
            <div style="width:3rem;height:3rem;border-radius:50%;background:{{ $catColors[$key] }};display:flex;align-items:center;justify-content:center;margin-bottom:.625rem;box-shadow:0 4px 12px {{ $catColors[$key] }}44;">
                {!! $catSvg[$key] !!}
            </div>
            <span style="font-size:1.625rem;font-weight:800;color:#f0e6c8;line-height:1;">{{ $counts[$key] ?? 0 }}</span>
            <span style="font-size:.7rem;color:#6b5c3e;margin-top:.3rem;text-align:center;font-weight:500;">{{ $label }}</span>
        </a>
        @endforeach
    </div>
</div>

{{-- Main --}}
<div style="background:#0d0a04;padding:3rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">

        {{-- Filters --}}
        <form method="GET" style="background:#1a1408;border:1px solid rgba(212,146,15,.15);border-radius:1rem;padding:1.25rem;margin-bottom:2rem;display:flex;flex-wrap:wrap;gap:.875rem;align-items:flex-end;">
            <div style="flex:1;min-width:200px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:rgba(212,146,15,.6);margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or organization..."
                    style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;box-sizing:border-box;">
            </div>
            <div style="min-width:160px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:rgba(212,146,15,.6);margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Type</label>
                <select name="type" style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#c9b48a;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Types</option>
                    @foreach($types as $k => $v)
                    <option value="{{ $k }}" {{ request('type')===$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:150px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:rgba(212,146,15,.6);margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Stage</label>
                <select name="stage" style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#c9b48a;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Stages</option>
                    @foreach($stages as $k => $v)
                    <option value="{{ $k }}" {{ request('stage')===$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.5rem 1.25rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;">Filter</button>
            @if(request()->hasAny(['search','type','stage']))
            <a href="{{ route('investors.index') }}" style="font-size:.875rem;color:rgba(212,146,15,.5);text-decoration:none;padding:.5rem 0;">✕ Clear</a>
            @endif
        </form>

        <p style="font-size:.875rem;color:#6b5c3e;margin-bottom:1.5rem;">{{ $investors->total() }} investor{{ $investors->total()!=1?'s':'' }} found</p>

        @if($investors->isEmpty())
        <div style="text-align:center;padding:5rem 0;color:#6b5c3e;">
            <div style="font-size:3rem;margin-bottom:1rem;">👤</div>
            <p style="font-size:1.125rem;font-weight:500;color:#9a8a6a;">No investors found</p>
        </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:1.25rem;">
            @foreach($investors as $inv)
            @php $ic = $catColors[$inv->investor_type] ?? '#d4920f'; @endphp
            <a href="{{ route('investors.show', $inv->id) }}" style="text-decoration:none;background:#1a1408;border:1px solid rgba(212,146,15,.12);border-radius:1.25rem;padding:1.5rem;display:flex;flex-direction:column;transition:all .25s;overflow:hidden;position:relative;" onmouseover="this.style.boxShadow='0 12px 30px rgba(0,0,0,.4)';this.style.transform='translateY(-3px)';this.style.borderColor='rgba(212,146,15,.35)';" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)';this.style.borderColor='rgba(212,146,15,.12)';">
                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:{{ $ic }};"></div>
                <div style="display:flex;align-items:flex-start;gap:.875rem;margin-bottom:1rem;">
                    <div style="width:3rem;height:3rem;border-radius:.875rem;background:{{ $ic }};display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:800;font-size:1rem;color:#fff;">
                        {{ strtoupper(substr($inv->user->name??'IN',0,2)) }}
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="display:flex;align-items:center;gap:.375rem;">
                            <span style="font-size:.9375rem;font-weight:700;color:#f0e6c8;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block;">{{ $inv->user->name }}</span>
                            @if($inv->verification_status==='verified')<svg width="14" height="14" viewBox="0 0 20 20" fill="#d4920f" style="flex-shrink:0;"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>@endif
                        </div>
                        <p style="font-size:.75rem;color:#7a6a4a;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inv->designation }}</p>
                        <p style="font-size:.7rem;color:#6b5c3e;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inv->organization }}</p>
                    </div>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:.375rem;margin-bottom:.875rem;">
                    <span style="font-size:.68rem;font-weight:600;padding:.2rem .6rem;border-radius:9999px;{{ $typeBadge[$inv->investor_type]??'background:rgba(212,146,15,.1);color:#d4920f;' }}">{{ $typeLabel[$inv->investor_type]??$inv->investor_type }}</span>
                    @if($inv->investment_stage)<span style="font-size:.68rem;background:rgba(255,255,255,.05);color:#7a6a4a;padding:.2rem .6rem;border-radius:9999px;">{{ $stageLabel[$inv->investment_stage]??$inv->investment_stage }}</span>@endif
                </div>
                @if($inv->bio)<p style="font-size:.78rem;color:#7a6a4a;line-height:1.5;margin:0 0 .875rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;flex:1;">{{ $inv->bio }}</p>@endif
                <div style="padding-top:.75rem;border-top:1px solid rgba(212,146,15,.08);margin-top:auto;">
                    @if($inv->sector_preferences)
                    <div style="display:flex;flex-wrap:wrap;gap:.3rem;margin-bottom:.5rem;">
                        @foreach(array_slice($inv->sector_preferences,0,3) as $sec)
                        <span style="font-size:.65rem;background:rgba(212,146,15,.08);color:#d4920f;padding:.15rem .5rem;border-radius:.375rem;font-weight:500;">{{ $sec }}</span>
                        @endforeach
                    </div>
                    @endif
                    @if($inv->ticket_size_min && $inv->ticket_size_max)
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <span style="font-size:.68rem;color:#6b5c3e;">Ticket Size</span>
                        <span style="font-size:.78rem;font-weight:700;color:#d4920f;">৳{{ number_format($inv->ticket_size_min/100000,0) }}L–৳{{ number_format($inv->ticket_size_max/100000,0) }}L</span>
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
<div style="background:linear-gradient(135deg,#1a1208,#241c0a);padding:4rem 1.5rem;text-align:center;">
    <div style="max-width:40rem;margin:0 auto;">
        <h2 style="font-size:2rem;font-weight:800;color:#fff;margin:0 0 .75rem;">Looking to Raise Capital?</h2>
        <p style="color:rgba(212,146,15,.55);font-size:1rem;margin:0 0 2rem;line-height:1.6;">Submit your startup and get discovered by our verified investor network.</p>
        <a href="{{ route('register.seeker') }}" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:1rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;display:inline-block;">Submit Your Startup →</a>
    </div>
</div>

@endsection
