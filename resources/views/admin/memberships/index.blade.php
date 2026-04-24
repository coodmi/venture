@extends('layouts.admin')
@section('title', 'Memberships')
@section('page-title', 'Membership Applications')

@section('content')
<div style="background:#fff;border-radius:.875rem;border:1px solid #e5e7eb;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);">

    {{-- Toolbar --}}
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #f3f4f6;background:#fafafa;display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;">
        <form method="GET" style="display:flex;gap:.625rem;flex-wrap:wrap;align-items:center;">
            <select name="status" style="background:#fff;border:1px solid #e5e7eb;color:#374151;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;cursor:pointer;">
                <option value="">All Status</option>
                @foreach(['submitted', 'under_review', 'approved', 'rejected', 'revision_required'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                @endforeach
            </select>
            <button type="submit"
                    style="background:#6366f1;color:#fff;font-size:.875rem;font-weight:600;padding:.5rem 1rem;border-radius:.5rem;border:none;cursor:pointer;display:flex;align-items:center;gap:.375rem;transition:background .15s;"
                    onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
                Filter
            </button>
        </form>
        <a href="{{ route('admin.memberships.plans') }}"
           style="display:inline-flex;align-items:center;gap:.375rem;color:#6366f1;text-decoration:none;font-size:.8125rem;font-weight:600;padding:.5rem 1rem;background:#eef2ff;border-radius:.5rem;transition:background .15s;"
           onmouseover="this.style.background='#e0e7ff';" onmouseout="this.style.background='#eef2ff';">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Manage Plans
        </a>
    </div>

    {{-- Table --}}
    <table style="width:100%;font-size:.875rem;border-collapse:collapse;">
        <thead style="background:#f8fafc;">
            <tr>
                @foreach(['Applicant','Plan','Status','Applied','Actions'] as $h)
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #f3f4f6;">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($memberships as $m)
            <tr style="border-bottom:1px solid #f9fafb;transition:background .1s;"
                onmouseover="this.style.background='#f8fafc';" onmouseout="this.style.background='transparent';">
                <td style="padding:.75rem 1rem;">
                    <p style="font-weight:600;color:#111827;margin:0 0 .125rem;">{{ $m->user->name }}</p>
                    <p style="font-size:.75rem;color:#9ca3af;margin:0;">{{ $m->user->email }}</p>
                </td>
                <td style="padding:.75rem 1rem;">
                    <span style="background:#f3f4f6;color:#374151;font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;">{{ $m->plan->name }}</span>
                </td>
                <td style="padding:.75rem 1rem;">
                    <span style="font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;
                        {{ $m->status === 'approved' ? 'background:#ecfdf5;color:#059669;' :
                           ($m->status === 'rejected' ? 'background:#fef2f2;color:#dc2626;' :
                           ($m->status === 'revision_required' ? 'background:#fff7ed;color:#d97706;' : 'background:#eff6ff;color:#3b82f6;')) }}">
                        {{ ucfirst(str_replace('_', ' ', $m->status)) }}
                    </span>
                </td>
                <td style="padding:.75rem 1rem;color:#9ca3af;font-size:.8125rem;">{{ $m->created_at->format('M d, Y') }}</td>
                <td style="padding:.75rem 1rem;">
                    <a href="{{ route('admin.memberships.show', $m) }}"
                       style="display:inline-flex;align-items:center;gap:.25rem;color:#6366f1;text-decoration:none;font-size:.8125rem;font-weight:600;padding:.25rem .625rem;background:#eef2ff;border-radius:.375rem;transition:background .15s;"
                       onmouseover="this.style.background='#e0e7ff';" onmouseout="this.style.background='#eef2ff';">
                        Review
                        <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding:1rem 1.25rem;border-top:1px solid #f3f4f6;">{{ $memberships->links() }}</div>
</div>
@endsection
