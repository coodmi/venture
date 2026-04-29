@extends('layouts.dashboard')
@section('title', 'Browse Opportunities')
@section('page-title', 'Browse Opportunities')

@section('content')
@php
$sectorColors=['FinTech'=>'#3b82f6','AgriTech'=>'#10b981','HealthTech'=>'#ef4444','EdTech'=>'#f97316','CleanTech'=>'#8b5cf6','E-Commerce'=>'#0891b2','FoodTech'=>'#f59e0b','LogiTech'=>'#6366f1','Technology'=>'#6366f1','Real Estate'=>'#0891b2','Manufacturing'=>'#64748b','Logistics'=>'#0891b2','Media'=>'#ec4899','Other'=>'#6b7280'];
$sectorGrads=['FinTech'=>'linear-gradient(135deg,#1a3c8f,#2563eb)','AgriTech'=>'linear-gradient(135deg,#14532d,#16a34a)','HealthTech'=>'linear-gradient(135deg,#991b1b,#ef4444)','EdTech'=>'linear-gradient(135deg,#c2410c,#f97316)','CleanTech'=>'linear-gradient(135deg,#5b21b6,#8b5cf6)','E-Commerce'=>'linear-gradient(135deg,#0e7490,#06b6d4)','FoodTech'=>'linear-gradient(135deg,#92400e,#f59e0b)','LogiTech'=>'linear-gradient(135deg,#1e1b4b,#6366f1)','Technology'=>'linear-gradient(135deg,#1e1b4b,#6366f1)','Other'=>'linear-gradient(135deg,#374151,#6b7280)'];
@endphp

<div style="display:flex;flex-direction:column;gap:1.5rem;">

    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="font-size:1.25rem;font-weight:700;color:#111827;margin:0;">Investment Opportunities</h2>
            <p style="font-size:.875rem;color:#6b7280;margin:.25rem 0 0;">{{ $opportunities->total() }} opportunities available</p>
        </div>
        @if(request()->hasAny(['search','sector','stage','type']))
        <a href="{{ route('investor.opportunities.index') }}"
           style="display:inline-flex;align-items:center;gap:.375rem;padding:.5rem 1rem;background:#fff;border:1px solid #e5e7eb;border-radius:.625rem;font-size:.8125rem;font-weight:500;color:#6b7280;text-decoration:none;">
            ✕ Clear Filters
        </a>
        @endif
    </div>

    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
        <form method="GET" style="display:flex;flex-wrap:wrap;gap:.875rem;align-items:flex-end;">
            <div style="flex:1;min-width:180px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#9ca3af;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search opportunities..."
                       style="width:100%;background:#f9fafb;border:1px solid #e5e7eb;color:#374151;font-size:.875rem;border-radius:.625rem;padding:.5rem .875rem;outline:none;box-sizing:border-box;"
                       onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#e5e7eb';">
            </div>
            <div style="min-width:150px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#9ca3af;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Sector</label>
                <select name="sector" style="width:100%;background:#f9fafb;border:1px solid #e5e7eb;color:#374151;font-size:.875rem;border-radius:.625rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Sectors</option>
                    @foreach(['Technology','FinTech','HealthTech','EdTech','AgriTech','CleanTech','E-Commerce','Real Estate','Manufacturing','Logistics','Media','Other'] as $s)
                        <option value="{{ $s }}" {{ request('sector')===$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:140px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#9ca3af;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Stage</label>
                <select name="stage" style="width:100%;background:#f9fafb;border:1px solid #e5e7eb;color:#374151;font-size:.875rem;border-radius:.625rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Stages</option>
                    @foreach(['Idea','MVP','Early Stage','Growth','Scale','Pre-Seed','Seed','Series A','Series B'] as $s)
                        <option value="{{ $s }}" {{ request('stage')===$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit"
                    style="background:#1a3c8f;color:#fff;font-size:.875rem;font-weight:600;padding:.5rem 1.25rem;border-radius:.625rem;border:none;cursor:pointer;white-space:nowrap;"
                    onmouseover="this.style.background='#0d2b6e';" onmouseout="this.style.background='#1a3c8f';">
                Apply Filters
            </button>
        </form>
    </div>

    <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
        @foreach([['key'=>'','label'=>'All Deals'],['key'=>'hot','label'=>'🔥 Hot Deals'],['key'=>'featured','label'=>'⭐ Featured']] as $t)
        @php $active = (request('type')===$t['key']||($t['key']===''&&!request('type'))); @endphp
        <a href="{{ route('investor.opportunities.index', array_merge(request()->except('type','page'), $t['key']?['type'=>$t['key']]:[]) ) }}"
           style="padding:.4rem 1rem;border-radius:.625rem;font-size:.8125rem;font-weight:600;text-decoration:none;{{ $active?'background:#1a3c8f;color:#fff;':'background:#fff;border:1px solid #e5e7eb;color:#6b7280;' }}">
            {{ $t['label'] }}
        </a>
        @endforeach
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:1.25rem;">
        @forelse($opportunities as $opp)
        @php
            $grad = $sectorGrads[$opp->sector] ?? 'linear-gradient(135deg,#374151,#6b7280)';
            $color = $sectorColors[$opp->sector] ?? '#6b7280';
        @endphp
        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);transition:all .2s;"
             onmouseover="this.style.boxShadow='0 8px 24px rgba(0,0,0,.1)';this.style.transform='translateY(-2px)';"
             onmouseout="this.style.boxShadow='0 1px 4px rgba(0,0,0,.04)';this.style.transform='translateY(0)';">
            <div style="height:6.5rem;background:{{ $grad }};position:relative;">
                <div style="position:absolute;top:.75rem;left:.75rem;display:flex;gap:.375rem;">
                    <span style="background:rgba(255,255,255,.2);backdrop-filter:blur(4px);border:1px solid rgba(255,255,255,.3);color:#fff;font-size:.65rem;font-weight:700;padding:.2rem .5rem;border-radius:9999px;">{{ $opp->stage }}</span>
                </div>
                <div style="position:absolute;top:.75rem;right:.75rem;display:flex;gap:.375rem;">
                    @if($opp->is_hot_deal)<span style="background:#ef4444;color:#fff;font-size:.65rem;font-weight:700;padding:.2rem .5rem;border-radius:9999px;">🔥 Hot</span>@endif
                    @if($opp->is_featured)<span style="background:#f59e0b;color:#fff;font-size:.65rem;font-weight:700;padding:.2rem .5rem;border-radius:9999px;">⭐</span>@endif
                </div>
                <div style="position:absolute;bottom:-1.125rem;left:1rem;width:2.25rem;height:2.25rem;background:#fff;border-radius:.5rem;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,.15);">
                    <span style="font-size:.65rem;font-weight:800;color:{{ $color }};">{{ strtoupper(substr($opp->title,0,2)) }}</span>
                </div>
            </div>
            <div style="padding:1.5rem 1rem 1rem;">
                <div style="margin-bottom:.5rem;">
                    <span style="font-size:.7rem;font-weight:600;color:{{ $color }};background:{{ $color }}18;padding:.2rem .5rem;border-radius:9999px;">{{ $opp->sector }}</span>
                    <span style="font-size:.7rem;color:#9ca3af;margin-left:.375rem;">· {{ $opp->location }}</span>
                </div>
                <h3 style="font-size:.9375rem;font-weight:700;color:#111827;margin:0 0 .375rem;line-height:1.3;">{{ $opp->title }}</h3>
                <p style="font-size:.8125rem;color:#6b7280;line-height:1.5;margin:0 0 1rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $opp->solution ?? $opp->business_problem }}</p>
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:.75rem;border-top:1px solid #f3f4f6;">
                    <div>
                        <p style="font-size:.65rem;color:#9ca3af;margin:0;text-transform:uppercase;letter-spacing:.05em;">Seeking</p>
                        <p style="font-size:1rem;font-weight:800;color:#1a3c8f;margin:0;">৳{{ number_format($opp->ask_amount) }}</p>
                    </div>
                    <a href="{{ route('investor.opportunities.show', $opp->slug) }}"
                       style="background:#1a3c8f;color:#fff;font-size:.8125rem;font-weight:600;padding:.5rem 1rem;border-radius:.625rem;text-decoration:none;"
                       onmouseover="this.style.background='#0d2b6e';" onmouseout="this.style.background='#1a3c8f';">
                        View →
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1;text-align:center;padding:4rem 1rem;">
            <div style="width:4rem;height:4rem;background:#f3f4f6;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                <svg width="24" height="24" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p style="font-size:1rem;font-weight:600;color:#374151;margin:0 0 .375rem;">No opportunities found</p>
            <p style="font-size:.875rem;color:#9ca3af;margin:0;">Try adjusting your filters or check back later</p>
        </div>
        @endforelse
    </div>

    <div>{{ $opportunities->withQueryString()->links() }}</div>

</div>
@endsection
