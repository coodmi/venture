@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
@php
    $statCards=[
        ['label'=>'Total Users',    'value'=>$stats['total_users'],          'icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','color'=>'#3b82f6','bg'=>'#eff6ff'],
        ['label'=>'Investors',      'value'=>$stats['total_investors'],      'icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 8v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z','color'=>'#10b981','bg'=>'#f0fdf4'],
        ['label'=>'Seekers',        'value'=>$stats['total_seekers'],        'icon'=>'M13 10V3L4 14h7v7l9-11h-7z','color'=>'#a855f7','bg'=>'#faf5ff'],
        ['label'=>'Opportunities',  'value'=>$stats['total_opportunities'],  'icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z','color'=>'#f97316','bg'=>'#fff7ed'],
        ['label'=>'Pending Review', 'value'=>$stats['pending_opportunities'],'icon'=>'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z','color'=>'#ef4444','bg'=>'#fef2f2'],
    ];
@endphp

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(5,1fr);gap:1rem;margin-bottom:1.5rem;">
    @foreach($statCards as $card)
    <div style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.25rem;position:relative;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <div style="position:absolute;top:0;left:0;right:0;height:3px;background:{{ $card['color'] }};"></div>
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:.75rem;">
            <p style="font-size:.7rem;font-weight:600;color:#8d98a1;text-transform:uppercase;letter-spacing:.08em;margin:0;">{{ $card['label'] }}</p>
            <div style="width:2rem;height:2rem;background:{{ $card['bg'] }};border-radius:.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="14" height="14" fill="none" stroke="{{ $card['color'] }}" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}"/></svg>
            </div>
        </div>
        <p style="font-size:1.875rem;font-weight:800;color:#0d2b6e;margin:0;line-height:1;">{{ $card['value'] }}</p>
    </div>
    @endforeach
</div>

{{-- 3 Column Grid --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;margin-bottom:1.5rem;">

    {{-- Recent Users --}}
    <div style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.25rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <h3 style="font-weight:700;color:#0d2b6e;font-size:.9375rem;margin:0;">Recent Users</h3>
            <a href="{{ route('admin.users.index') }}" style="font-size:.75rem;color:#1a3c8f;text-decoration:none;font-weight:600;">View all →</a>
        </div>
        @foreach($recentUsers as $user)
        <div style="display:flex;align-items:center;gap:.75rem;padding:.625rem 0;border-bottom:1px solid #f1f5f9;">
            <div style="width:2rem;height:2rem;background:#eff6ff;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span style="color:#1a3c8f;font-weight:700;font-size:.75rem;">{{ substr($user->name,0,1) }}</span>
            </div>
            <div style="flex:1;min-width:0;">
                <p style="font-size:.8125rem;font-weight:600;color:#0d2b6e;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $user->name }}</p>
                <p style="font-size:.7rem;color:#8d98a1;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $user->email }}</p>
            </div>
            <span style="font-size:.65rem;font-weight:600;padding:.15rem .5rem;border-radius:9999px;{{ $user->status==='active'?'background:#f0fdf4;color:#16a34a;':'background:#fff7ed;color:#f97316;' }}">
                {{ $user->status }}
            </span>
        </div>
        @endforeach
    </div>

    {{-- Recent Opportunities --}}
    <div style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.25rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <h3 style="font-weight:700;color:#0d2b6e;font-size:.9375rem;margin:0;">Recent Opportunities</h3>
            <a href="{{ route('admin.opportunities.index') }}" style="font-size:.75rem;color:#1a3c8f;text-decoration:none;font-weight:600;">View all →</a>
        </div>
        @foreach($recentOpportunities as $opp)
        <div style="padding:.625rem 0;border-bottom:1px solid #f1f5f9;">
            <p style="font-size:.8125rem;font-weight:600;color:#0d2b6e;margin:0 0 .25rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $opp->title }}</p>
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <p style="font-size:.7rem;color:#8d98a1;margin:0;">{{ $opp->user->name }}</p>
                <span style="font-size:.65rem;font-weight:600;padding:.15rem .5rem;border-radius:9999px;
                    {{ $opp->status==='approved'?'background:#f0fdf4;color:#16a34a;':($opp->status==='submitted'?'background:#fff7ed;color:#f97316;':'background:#f1f5f9;color:#8d98a1;') }}">
                    {{ ucfirst($opp->status) }}
                </span>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pending Memberships --}}
    <div style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.25rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <h3 style="font-weight:700;color:#0d2b6e;font-size:.9375rem;margin:0;">Pending Memberships</h3>
            <a href="{{ route('admin.memberships.index') }}" style="font-size:.75rem;color:#1a3c8f;text-decoration:none;font-weight:600;">View all →</a>
        </div>
        @forelse($pendingMemberships as $m)
        <div style="padding:.625rem 0;border-bottom:1px solid #f1f5f9;">
            <p style="font-size:.8125rem;font-weight:600;color:#0d2b6e;margin:0 0 .125rem;">{{ $m->user->name }}</p>
            <p style="font-size:.7rem;color:#8d98a1;margin:0 0 .25rem;">{{ $m->plan->name }}</p>
            <a href="{{ route('admin.memberships.show',$m) }}" style="font-size:.75rem;color:#f97316;text-decoration:none;font-weight:600;">Review →</a>
        </div>
        @empty
        <p style="font-size:.875rem;color:#8d98a1;text-align:center;padding:1.5rem 0;">No pending memberships.</p>
        @endforelse
    </div>
</div>

{{-- Quick Actions --}}
<div style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.25rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
    <h3 style="font-weight:700;color:#0d2b6e;font-size:.9375rem;margin:0 0 1rem;">Quick Actions</h3>
    <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
        <a href="{{ route('admin.news.create') }}" style="background:#f97316;color:#fff;font-size:.8125rem;font-weight:700;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;">+ Add News</a>
        <a href="{{ route('admin.events.create') }}" style="background:#f0fdf4;border:1px solid #bbf7d0;color:#16a34a;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;">+ Add Event</a>
        <a href="{{ route('admin.opportunities.index') }}?status=submitted" style="background:#fff7ed;border:1px solid #fed7aa;color:#f97316;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;">Review Opportunities</a>
        <a href="{{ route('admin.settings.stats') }}" style="background:#f4f7fb;border:1px solid #dde3ea;color:#374151;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;">Update Stats</a>
        <a href="{{ route('admin.settings.hero') }}" style="background:#eff6ff;border:1px solid #bfdbfe;color:#1a3c8f;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;">Edit Hero Slider</a>
    </div>
</div>

@endsection
