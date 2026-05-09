@extends('layouts.admin')
@section('title', 'Investors')
@section('page-title', 'Investor Profiles')

@section('content')
@php
$inp = "background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.45rem .75rem;font-size:.8125rem;outline:none;";
$typeLabels = ['angel'=>'Angel','vc'=>'Venture Capital','corporate'=>'Corporate','family_office'=>'Family Office','impact'=>'Impact'];
$statusColors = ['verified'=>'background:#f0fdf4;color:#16a34a;','pending'=>'background:#fffbeb;color:#d97706;','rejected'=>'background:#fef2f2;color:#dc2626;'];
@endphp

{{-- Filters --}}
<form method="GET" style="display:flex;gap:.75rem;flex-wrap:wrap;margin-bottom:1.5rem;align-items:center;">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, org…" style="{{ $inp }}width:220px;">
    <select name="type" style="{{ $inp }}cursor:pointer;">
        <option value="">All Types</option>
        @foreach($typeLabels as $val => $label)
        <option value="{{ $val }}" {{ request('type')===$val?'selected':'' }}>{{ $label }}</option>
        @endforeach
    </select>
    <select name="status" style="{{ $inp }}cursor:pointer;">
        <option value="">All Status</option>
        @foreach(['pending','verified','rejected'] as $s)
        <option value="{{ $s }}" {{ request('status')===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    <button type="submit" style="background:#6366f1;color:#fff;font-size:.8125rem;font-weight:600;padding:.45rem 1rem;border-radius:.5rem;border:none;cursor:pointer;">Filter</button>
    @if(request()->hasAny(['search','type','status']))
    <a href="{{ route('admin.investors.index') }}" style="font-size:.8125rem;color:#6b7280;text-decoration:none;padding:.45rem .75rem;background:#f3f4f6;border-radius:.5rem;">Clear</a>
    @endif
</form>

<div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);">
    <table style="width:100%;border-collapse:collapse;font-size:.8125rem;">
        <thead>
            <tr style="background:#f9fafb;border-bottom:1px solid #e5e7eb;">
                <th style="padding:.75rem 1rem;text-align:left;font-weight:600;color:#374151;">Investor</th>
                <th style="padding:.75rem 1rem;text-align:left;font-weight:600;color:#374151;">Type</th>
                <th style="padding:.75rem 1rem;text-align:left;font-weight:600;color:#374151;">Organization</th>
                <th style="padding:.75rem 1rem;text-align:left;font-weight:600;color:#374151;">Stage</th>
                <th style="padding:.75rem 1rem;text-align:left;font-weight:600;color:#374151;">Verification</th>
                <th style="padding:.75rem 1rem;text-align:left;font-weight:600;color:#374151;">Account</th>
                <th style="padding:.75rem 1rem;text-align:left;font-weight:600;color:#374151;">Completion</th>
                <th style="padding:.75rem 1rem;text-align:center;font-weight:600;color:#374151;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($profiles as $profile)
            <tr style="border-bottom:1px solid #f3f4f6;" onmouseover="this.style.background='#fafafa';" onmouseout="this.style.background='transparent';">
                <td style="padding:.75rem 1rem;">
                    <div style="display:flex;align-items:center;gap:.625rem;">
                        @if($profile->photo)
                            <img src="{{ Storage::url($profile->photo) }}" style="width:2.25rem;height:2.25rem;border-radius:50%;object-fit:cover;border:2px solid #e0e7ff;flex-shrink:0;">
                        @else
                            <div style="width:2.25rem;height:2.25rem;background:linear-gradient(135deg,#1a3c8f,#3b5fc0);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <span style="color:#fff;font-weight:700;font-size:.75rem;">{{ strtoupper(substr($profile->user->name,0,1)) }}</span>
                            </div>
                        @endif
                        <div>
                            <div style="font-weight:600;color:#111827;">{{ $profile->user->name }}</div>
                            <div style="color:#9ca3af;font-size:.75rem;">{{ $profile->user->email }}</div>
                        </div>
                    </div>
                </td>
                <td style="padding:.75rem 1rem;color:#374151;">{{ $typeLabels[$profile->investor_type] ?? ucfirst($profile->investor_type ?? '—') }}</td>
                <td style="padding:.75rem 1rem;color:#374151;">{{ $profile->organization ?? '—' }}</td>
                <td style="padding:.75rem 1rem;color:#374151;">{{ $profile->investment_stage ?? '—' }}</td>
                <td style="padding:.75rem 1rem;">
                    @php $vs = $profile->verification_status ?? 'pending'; @endphp
                    <span style="font-size:.7rem;font-weight:600;padding:.25rem .625rem;border-radius:9999px;{{ $statusColors[$vs] ?? $statusColors['pending'] }}">{{ ucfirst($vs) }}</span>
                </td>
                <td style="padding:.75rem 1rem;">
                    @php $us = $profile->user->status; $uc = $us==='active'?'background:#f0fdf4;color:#16a34a;':($us==='suspended'?'background:#fef2f2;color:#dc2626;':'background:#fffbeb;color:#d97706;'); @endphp
                    <span style="font-size:.7rem;font-weight:600;padding:.25rem .625rem;border-radius:9999px;{{ $uc }}">{{ ucfirst($us) }}</span>
                </td>
                <td style="padding:.75rem 1rem;">
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <div style="flex:1;height:.375rem;background:#e5e7eb;border-radius:9999px;min-width:60px;">
                            <div style="height:100%;background:#6366f1;border-radius:9999px;width:{{ $profile->profile_completion ?? 0 }}%;"></div>
                        </div>
                        <span style="font-size:.7rem;color:#6b7280;font-weight:600;">{{ $profile->profile_completion ?? 0 }}%</span>
                    </div>
                </td>
                <td style="padding:.75rem 1rem;text-align:center;">
                    <a href="{{ route('admin.investors.edit', $profile) }}"
                       style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-size:.75rem;font-weight:600;padding:.375rem .75rem;border-radius:.5rem;text-decoration:none;"
                       onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="padding:3rem;text-align:center;color:#9ca3af;">No investor profiles found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($profiles->hasPages())
<div style="margin-top:1.25rem;">{{ $profiles->withQueryString()->links() }}</div>
@endif
@endsection
