@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
@php
    $statCards=[
        ['label'=>'Total Users',    'value'=>$stats['total_users'],           'icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'color'=>'#6366f1','light'=>'#eef2ff','text'=>'#4338ca'],
        ['label'=>'Investors',      'value'=>$stats['total_investors'],       'icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 8v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color'=>'#10b981','light'=>'#ecfdf5','text'=>'#065f46'],
        ['label'=>'Seekers',        'value'=>$stats['total_seekers'],         'icon'=>'M13 10V3L4 14h7v7l9-11h-7z', 'color'=>'#f59e0b','light'=>'#fffbeb','text'=>'#92400e'],
        ['label'=>'Opportunities',  'value'=>$stats['total_opportunities'],   'icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'color'=>'#3b82f6','light'=>'#eff6ff','text'=>'#1d4ed8'],
        ['label'=>'Pending Review', 'value'=>$stats['pending_opportunities'], 'icon'=>'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color'=>'#ef4444','light'=>'#fef2f2','text'=>'#991b1b'],
    ];
@endphp

{{-- Welcome bar --}}
<div style="background:linear-gradient(135deg,#6366f1 0%,#8b5cf6 100%);border-radius:1rem;padding:1.5rem 1.75rem;margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between;box-shadow:0 4px 20px rgba(99,102,241,.25);">
    <div>
        <p style="font-size:.75rem;color:rgba(255,255,255,.7);margin:0 0 .25rem;font-weight:500;text-transform:uppercase;letter-spacing:.08em;">Welcome back</p>
        <h2 style="font-size:1.25rem;font-weight:700;color:#fff;margin:0;">{{ auth()->user()->name }}</h2>
        <p style="font-size:.8125rem;color:rgba(255,255,255,.65);margin:.25rem 0 0;">Here's what's happening on your platform today.</p>
    </div>
    <div style="width:3.5rem;height:3.5rem;background:rgba(255,255,255,.15);border-radius:1rem;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px);">
        <svg width="24" height="24" fill="none" stroke="rgba(255,255,255,.9)" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
    </div>
</div>

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(5,1fr);gap:1rem;margin-bottom:1.5rem;">
    @foreach($statCards as $card)
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:.875rem;padding:1.25rem;position:relative;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);transition:box-shadow .2s;"
         onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,.08)';"
         onmouseout="this.style.boxShadow='0 1px 4px rgba(0,0,0,.04)';">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:.875rem;">
            <div style="width:2.5rem;height:2.5rem;background:{{ $card['light'] }};border-radius:.75rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="16" height="16" fill="none" stroke="{{ $card['color'] }}" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}"/></svg>
            </div>
        </div>
        <p style="font-size:1.75rem;font-weight:800;color:#111827;margin:0 0 .25rem;line-height:1;">{{ $card['value'] }}</p>
        <p style="font-size:.75rem;font-weight:500;color:#6b7280;margin:0;">{{ $card['label'] }}</p>
        <div style="position:absolute;bottom:0;left:0;right:0;height:3px;background:{{ $card['color'] }};opacity:.6;border-radius:0 0 .875rem .875rem;"></div>
    </div>
    @endforeach
</div>

{{-- 3 Column Grid --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;margin-bottom:1.5rem;">

    {{-- Recent Users --}}
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:.875rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0;">Recent Users</h3>
            <a href="{{ route('admin.users.index') }}" style="font-size:.75rem;color:#6366f1;text-decoration:none;font-weight:600;padding:.25rem .625rem;background:#eef2ff;border-radius:.375rem;">View all</a>
        </div>
        @foreach($recentUsers as $user)
        <div style="display:flex;align-items:center;gap:.75rem;padding:.625rem 0;border-bottom:1px solid #f3f4f6;">
            <div style="width:2rem;height:2rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span style="color:#fff;font-weight:700;font-size:.7rem;">{{ strtoupper(substr($user->name,0,1)) }}</span>
            </div>
            <div style="flex:1;min-width:0;">
                <p style="font-size:.8125rem;font-weight:600;color:#111827;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $user->name }}</p>
                <p style="font-size:.7rem;color:#9ca3af;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $user->email }}</p>
            </div>
            <span style="font-size:.65rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;{{ $user->status==='active'?'background:#ecfdf5;color:#059669;':'background:#fff7ed;color:#d97706;' }}">
                {{ ucfirst($user->status) }}
            </span>
        </div>
        @endforeach
    </div>

    {{-- Recent Opportunities --}}
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:.875rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0;">Recent Opportunities</h3>
            <a href="{{ route('admin.opportunities.index') }}" style="font-size:.75rem;color:#6366f1;text-decoration:none;font-weight:600;padding:.25rem .625rem;background:#eef2ff;border-radius:.375rem;">View all</a>
        </div>
        @foreach($recentOpportunities as $opp)
        <div style="padding:.625rem 0;border-bottom:1px solid #f3f4f6;">
            <p style="font-size:.8125rem;font-weight:600;color:#111827;margin:0 0 .25rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $opp->title }}</p>
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <p style="font-size:.7rem;color:#9ca3af;margin:0;">{{ $opp->user->name }}</p>
                <span style="font-size:.65rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;
                    {{ $opp->status==='approved'?'background:#ecfdf5;color:#059669;':($opp->status==='submitted'?'background:#fff7ed;color:#d97706;':'background:#f3f4f6;color:#6b7280;') }}">
                    {{ ucfirst($opp->status) }}
                </span>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pending Memberships --}}
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:.875rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0;">Pending Memberships</h3>
            <a href="{{ route('admin.memberships.index') }}" style="font-size:.75rem;color:#6366f1;text-decoration:none;font-weight:600;padding:.25rem .625rem;background:#eef2ff;border-radius:.375rem;">View all</a>
        </div>
        @forelse($pendingMemberships as $m)
        <div style="padding:.625rem 0;border-bottom:1px solid #f3f4f6;">
            <p style="font-size:.8125rem;font-weight:600;color:#111827;margin:0 0 .125rem;">{{ $m->user->name }}</p>
            <p style="font-size:.7rem;color:#9ca3af;margin:0 0 .375rem;">{{ $m->plan->name }}</p>
            <a href="{{ route('admin.memberships.show',$m) }}"
               style="font-size:.75rem;color:#6366f1;text-decoration:none;font-weight:600;display:inline-flex;align-items:center;gap:.25rem;">
               Review
               <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        @empty
        <div style="text-align:center;padding:2rem 0;">
            <svg width="32" height="32" fill="none" stroke="#d1d5db" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto .5rem;display:block;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p style="font-size:.8125rem;color:#9ca3af;margin:0;">All caught up!</p>
        </div>
        @endforelse
    </div>
</div>

{{-- Quick Actions --}}
<div style="background:#fff;border:1px solid #e5e7eb;border-radius:.875rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
    <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Quick Actions</h3>
    <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
        <a href="{{ route('admin.news.create') }}"
           style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;box-shadow:0 2px 8px rgba(99,102,241,.3);transition:all .15s;"
           onmouseover="this.style.background='#4f46e5';this.style.transform='translateY(-1px)';"
           onmouseout="this.style.background='#6366f1';this.style.transform='translateY(0)';">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add News
        </a>
        <a href="{{ route('admin.events.create') }}"
           style="display:inline-flex;align-items:center;gap:.375rem;background:#ecfdf5;border:1px solid #a7f3d0;color:#059669;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;transition:all .15s;"
           onmouseover="this.style.background='#d1fae5';this.style.transform='translateY(-1px)';"
           onmouseout="this.style.background='#ecfdf5';this.style.transform='translateY(0)';">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Event
        </a>
        <a href="{{ route('admin.opportunities.index') }}?status=submitted"
           style="display:inline-flex;align-items:center;gap:.375rem;background:#fff7ed;border:1px solid #fed7aa;color:#d97706;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;transition:all .15s;"
           onmouseover="this.style.background='#ffedd5';this.style.transform='translateY(-1px)';"
           onmouseout="this.style.background='#fff7ed';this.style.transform='translateY(0)';">
            Review Opportunities
        </a>
        <a href="{{ route('admin.settings.stats') }}"
           style="display:inline-flex;align-items:center;gap:.375rem;background:#f3f4f6;border:1px solid #e5e7eb;color:#374151;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;transition:all .15s;"
           onmouseover="this.style.background='#e5e7eb';this.style.transform='translateY(-1px)';"
           onmouseout="this.style.background='#f3f4f6';this.style.transform='translateY(0)';">
            Update Stats
        </a>
        <a href="{{ route('admin.settings.hero') }}"
           style="display:inline-flex;align-items:center;gap:.375rem;background:#eef2ff;border:1px solid #c7d2fe;color:#4338ca;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;transition:all .15s;"
           onmouseover="this.style.background='#e0e7ff';this.style.transform='translateY(-1px)';"
           onmouseout="this.style.background='#eef2ff';this.style.transform='translateY(0)';">
            Edit Hero Slider
        </a>
    </div>
</div>

@endsection
