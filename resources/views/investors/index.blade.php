@extends('layouts.app')
@section('title', 'Top Investors')

@section('content')

{{-- Hero --}}
<div style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 60%,#1d4ed8 100%);color:#fff;padding:4rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <span style="display:inline-block;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.8);font-size:.75rem;font-weight:600;padding:.25rem .75rem;border-radius:9999px;margin-bottom:1.25rem;">💼 Investment Community</span>
        <h1 style="font-size:clamp(2rem,5vw,3rem);font-weight:800;margin-bottom:.75rem;line-height:1.2;">Meet Our <span style="color:#fbbf24;">Investors</span></h1>
        <p style="color:rgba(255,255,255,.6);font-size:1.1rem;max-width:36rem;">Connect with {{ array_sum($counts) }}+ verified investors actively seeking opportunities in Bangladesh.</p>
    </div>
</div>

{{-- Category Stats --}}
@php
    $catColors = ['angel'=>'#f59e0b','vc'=>'#3b82f6','corporate'=>'#6366f1','family_office'=>'#a855f7','impact'=>'#10b981'];
    $catSvg = [
        'angel'         => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:1.5rem;height:1.5rem;"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
        'vc'            => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:1.5rem;height:1.5rem;"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>',
        'corporate'     => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:1.5rem;height:1.5rem;"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>',
        'family_office' => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:1.5rem;height:1.5rem;"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
        'impact'        => '<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:1.5rem;height:1.5rem;"><path d="M12 22V12M12 12C12 7 7 4 3 6M12 12c0-5 5-8 9-6M7 17c1.5-1 3.5-1.5 5-1.5s3.5.5 5 1.5"/></svg>',
    ];
    $typeLabel = ['angel'=>'Angel Investor','vc'=>'Venture Capital','corporate'=>'Corporate','family_office'=>'Family Office','impact'=>'Impact Investor'];
    $stageLabel = ['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
    $typeBadgeStyle = ['angel'=>'background:#fef3c7;color:#92400e;','vc'=>'background:#dbeafe;color:#1e40af;','corporate'=>'background:#e0e7ff;color:#3730a3;','family_office'=>'background:#f3e8ff;color:#6b21a8;','impact'=>'background:#d1fae5;color:#065f46;'];
@endphp

<div style="background:#fff;border-bottom:1px solid #e5e7eb;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;display:grid;grid-template-columns:repeat(5,1fr);">
        @foreach($types as $key => $label)
        <a href="{{ route('investors.index', ['type'=>$key]) }}"
           style="display:flex;flex-direction:column;align-items:center;padding:1.75rem 1rem;text-decoration:none;border-bottom:3px solid {{ request('type')===$key ? $catColors[$key] : 'transparent' }};transition:all .2s;background:{{ request('type')===$key ? '#f8fafc' : 'transparent' }};">
            <div style="width:3rem;height:3rem;border-radius:50%;background:{{ $catColors[$key] }};display:flex;align-items:center;justify-content:center;margin-bottom:.625rem;box-shadow:0 4px 12px {{ $catColors[$key] }}55;">
                {!! $catSvg[$key] !!}
            </div>
            <span style="font-size:1.625rem;font-weight:800;color:#111827;line-height:1;">{{ $counts[$key] ?? 0 }}</span>
            <span style="font-size:.7rem;color:#6b7280;margin-top:.3rem;text-align:center;font-weight:500;">{{ $label }}</span>
        </a>
        @endforeach
    </div>
</div>

{{-- Filters --}}
<div style="background:#f9fafb;padding:2rem 1.5rem 0;">
    <div style="max-width:80rem;margin:0 auto;">
        <form method="GET" style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;display:flex;flex-wrap:wrap;gap:.75rem;align-items:flex-end;box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <div style="flex:1;min-width:200px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#6b7280;margin-bottom:.35rem;text-transform:uppercase;letter-spacing:.05em;">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or organization..."
                    style="width:100%;border:1px solid #d1d5db;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
            </div>
            <div style="min-width:160px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#6b7280;margin-bottom:.35rem;text-transform:uppercase;letter-spacing:.05em;">Type</label>
                <select name="type" style="width:100%;border:1px solid #d1d5db;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;">
                    <option value="">All Types</option>
                    @foreach($types as $k => $v)
                    <option value="{{ $k }}" {{ request('type')===$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:150px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#6b7280;margin-bottom:.35rem;text-transform:uppercase;letter-spacing:.05em;">Stage</label>
                <select name="stage" style="width:100%;border:1px solid #d1d5db;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;">
                    <option value="">All Stages</option>
                    @foreach($stages as $k => $v)
                    <option value="{{ $k }}" {{ request('stage')===$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="background:#2563eb;color:#fff;font-weight:600;padding:.5rem 1.25rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;">Filter</button>
            @if(request()->hasAny(['search','type','stage']))
            <a href="{{ route('investors.index') }}" style="font-size:.875rem;color:#9ca3af;text-decoration:none;padding:.5rem 0;">✕ Clear</a>
            @endif
        </form>
    </div>
</div>

{{-- Grid --}}
<div style="background:#f9fafb;padding:2rem 1.5rem 4rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <p style="font-size:.875rem;color:#6b7280;margin-bottom:1.5rem;">{{ $investors->total() }} investor{{ $investors->total()!=1?'s':'' }} found</p>

        @if($investors->isEmpty())
        <div style="text-align:center;padding:5rem 0;color:#9ca3af;">
            <div style="font-size:3rem;margin-bottom:1rem;">🔍</div>
            <p style="font-size:1.125rem;font-weight:500;">No investors found</p>
        </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.25rem;">
            @foreach($investors as $inv)
            <a href="{{ route('investors.show', $inv->id) }}" style="text-decoration:none;display:flex;flex-direction:column;background:#fff;border-radius:1rem;border:1px solid #e5e7eb;overflow:hidden;transition:all .25s;box-shadow:0 1px 3px rgba(0,0,0,.04);"
               onmouseover="this.style.boxShadow='0 8px 25px rgba(0,0,0,.1)';this.style.transform='translateY(-3px)';this.style.borderColor='#93c5fd';"
               onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,.04)';this.style.transform='translateY(0)';this.style.borderColor='#e5e7eb';">

                {{-- Color bar --}}
                <div style="height:4px;background:{{ $catColors[$inv->investor_type] ?? '#3b82f6' }};"></div>

                <div style="padding:1.5rem;flex:1;display:flex;flex-direction:column;">
                    {{-- Header --}}
                    <div style="display:flex;align-items:flex-start;gap:.875rem;margin-bottom:1rem;">
                        <div style="width:3rem;height:3rem;border-radius:.75rem;background:{{ $catColors[$inv->investor_type] ?? '#3b82f6' }};display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:1rem;flex-shrink:0;">
                            {{ strtoupper(substr($inv->user->name ?? 'IN', 0, 2)) }}
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="display:flex;align-items:center;gap:.375rem;">
                                <span style="font-weight:700;color:#111827;font-size:.9375rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block;">{{ $inv->user->name }}</span>
                                @if($inv->verification_status === 'verified')
                                <span style="color:#3b82f6;flex-shrink:0;" title="Verified">✓</span>
                                @endif
                            </div>
                            <p style="font-size:.75rem;color:#6b7280;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inv->designation }}</p>
                            <p style="font-size:.7rem;color:#9ca3af;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inv->organization }}</p>
                        </div>
                    </div>

                    {{-- Badges --}}
                    <div style="display:flex;flex-wrap:wrap;gap:.375rem;margin-bottom:.875rem;">
                        <span style="font-size:.7rem;font-weight:600;padding:.2rem .6rem;border-radius:9999px;{{ $typeBadgeStyle[$inv->investor_type] ?? 'background:#f3f4f6;color:#374151;' }}">
                            {{ $typeLabel[$inv->investor_type] ?? $inv->investor_type }}
                        </span>
                        @if($inv->investment_stage)
                        <span style="font-size:.7rem;background:#f3f4f6;color:#374151;padding:.2rem .6rem;border-radius:9999px;">{{ $stageLabel[$inv->investment_stage] ?? $inv->investment_stage }}</span>
                        @endif
                    </div>

                    {{-- Bio --}}
                    @if($inv->bio)
                    <p style="font-size:.8125rem;color:#6b7280;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;flex:1;margin-bottom:1rem;">{{ $inv->bio }}</p>
                    @endif

                    {{-- Footer --}}
                    <div style="border-top:1px solid #f3f4f6;padding-top:.875rem;">
                        @if($inv->sector_preferences)
                        <div style="display:flex;flex-wrap:wrap;gap:.3rem;margin-bottom:.5rem;">
                            @foreach(array_slice($inv->sector_preferences, 0, 3) as $sector)
                            <span style="font-size:.7rem;background:#eff6ff;color:#1d4ed8;padding:.15rem .5rem;border-radius:.375rem;font-weight:500;">{{ $sector }}</span>
                            @endforeach
                        </div>
                        @endif
                        @if($inv->ticket_size_min && $inv->ticket_size_max)
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <span style="font-size:.7rem;color:#9ca3af;">Ticket Size</span>
                            <span style="font-size:.75rem;font-weight:700;color:#1d4ed8;">৳{{ number_format($inv->ticket_size_min/100000,0) }}L – ৳{{ number_format($inv->ticket_size_max/100000,0) }}L</span>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div style="margin-top:2.5rem;">{{ $investors->withQueryString()->links() }}</div>
        @endif
    </div>
</div>

@endsection
