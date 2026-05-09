@extends('layouts.admin')
@section('title', 'Startups')
@section('page-title', 'Startup Management')

@section('content')
<div style="background:#fff;border-radius:.875rem;border:1px solid #e5e7eb;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);">

    {{-- Toolbar --}}
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #f3f4f6;background:#fafafa;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;">
        <form method="GET" style="display:flex;gap:.625rem;flex-wrap:wrap;align-items:center;">
            <select name="status" style="background:#fff;border:1px solid #e5e7eb;color:#374151;border-radius:.5rem;padding:.5rem .75rem;font-size:.8125rem;outline:none;cursor:pointer;">
                <option value="">All Status</option>
                @foreach(['draft','submitted','under_review','approved','rejected','archived'] as $s)
                <option value="{{ $s }}" {{ request('status')===$s?'selected':'' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                @endforeach
            </select>
            <select name="sector" style="background:#fff;border:1px solid #e5e7eb;color:#374151;border-radius:.5rem;padding:.5rem .75rem;font-size:.8125rem;outline:none;cursor:pointer;">
                <option value="">All Sectors</option>
                @foreach(['FinTech','AgriTech','HealthTech','EdTech','CleanTech','Technology','E-Commerce','Real Estate','Manufacturing','Logistics','Media','Other'] as $s)
                <option value="{{ $s }}" {{ request('sector')===$s?'selected':'' }}>{{ $s }}</option>
                @endforeach
            </select>
            <button type="submit" style="background:#6366f1;color:#fff;font-size:.8125rem;font-weight:600;padding:.5rem 1rem;border-radius:.5rem;border:none;cursor:pointer;display:flex;align-items:center;gap:.375rem;" onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
                Filter
            </button>
        </form>
        <a href="{{ route('admin.opportunities.create') }}" style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-size:.8125rem;font-weight:600;padding:.5rem 1rem;border-radius:.5rem;text-decoration:none;" onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Startup
        </a>
    </div>

    {{-- Table --}}
    <table style="width:100%;font-size:.8125rem;border-collapse:collapse;">
        <thead style="background:#f8fafc;">
            <tr>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #f3f4f6;">Startup</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #f3f4f6;">Founder</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #f3f4f6;">Sector</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #f3f4f6;">Ask</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #f3f4f6;">Status</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #f3f4f6;">Flags</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #f3f4f6;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($opportunities as $opp)
            @php
                $seekerProfile = $opp->seekerProfile;
                $founderPhoto  = $seekerProfile?->photo;
                $companyLogo   = $seekerProfile?->company_logo;
                $founderName   = $opp->user?->name ?? '—';
                $statusStyle   = match($opp->status) {
                    'approved'     => 'background:#ecfdf5;color:#059669;',
                    'submitted'    => 'background:#fff7ed;color:#d97706;',
                    'under_review' => 'background:#eff6ff;color:#3b82f6;',
                    'rejected'     => 'background:#fef2f2;color:#dc2626;',
                    default        => 'background:#f3f4f6;color:#6b7280;',
                };
            @endphp
            <tr style="border-bottom:1px solid #f9fafb;transition:background .1s;" onmouseover="this.style.background='#f8fafc';" onmouseout="this.style.background='transparent';">

                {{-- Startup: logo + title + stage --}}
                <td style="padding:.75rem 1rem;">
                    <div style="display:flex;align-items:center;gap:.625rem;">
                        @if($companyLogo)
                            <img src="{{ Storage::url($companyLogo) }}" style="width:2.25rem;height:2.25rem;border-radius:.5rem;object-fit:cover;border:1px solid #e5e7eb;flex-shrink:0;">
                        @else
                            <div style="width:2.25rem;height:2.25rem;border-radius:.5rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <span style="color:#fff;font-weight:800;font-size:.7rem;">{{ strtoupper(substr($opp->title,0,2)) }}</span>
                            </div>
                        @endif
                        <div>
                            <div style="font-weight:600;color:#111827;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:160px;">{{ $opp->title }}</div>
                            @if($opp->stage)<div style="font-size:.7rem;color:#9ca3af;margin-top:.1rem;">{{ $opp->stage }}</div>@endif
                        </div>
                    </div>
                </td>

                {{-- Founder: photo + name + email --}}
                <td style="padding:.75rem 1rem;">
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        @if($founderPhoto)
                            <img src="{{ Storage::url($founderPhoto) }}" style="width:1.875rem;height:1.875rem;border-radius:50%;object-fit:cover;border:2px solid #e0e7ff;flex-shrink:0;">
                        @else
                            <div style="width:1.875rem;height:1.875rem;border-radius:50%;background:linear-gradient(135deg,#f97316,#fb923c);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <span style="color:#fff;font-weight:700;font-size:.625rem;">{{ strtoupper(substr($founderName,0,1)) }}</span>
                            </div>
                        @endif
                        <div>
                            <div style="font-weight:500;color:#374151;white-space:nowrap;font-size:.8125rem;">{{ $founderName }}</div>
                            @if($opp->user?->email)<div style="font-size:.7rem;color:#9ca3af;">{{ $opp->user->email }}</div>@endif
                        </div>
                    </div>
                </td>

                {{-- Sector --}}
                <td style="padding:.75rem 1rem;">
                    @if($opp->sector)
                    <span style="background:#f3f4f6;color:#374151;font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;">{{ $opp->sector }}</span>
                    @else <span style="color:#d1d5db;">—</span> @endif
                </td>

                {{-- Ask --}}
                <td style="padding:.75rem 1rem;font-weight:700;color:#6366f1;white-space:nowrap;">
                    @if($opp->ask_amount)
                        {{ $opp->ask_currency ?? '৳' }} {{ number_format($opp->ask_amount) }}
                    @else <span style="color:#d1d5db;">—</span> @endif
                </td>

                {{-- Status --}}
                <td style="padding:.75rem 1rem;">
                    <span style="font-size:.7rem;font-weight:600;padding:.25rem .625rem;border-radius:9999px;{{ $statusStyle }}">
                        {{ ucfirst(str_replace('_',' ',$opp->status)) }}
                    </span>
                </td>

                {{-- Flags --}}
                <td style="padding:.75rem 1rem;white-space:nowrap;">
                    @if($opp->is_hot_deal)<span title="Hot Deal" style="font-size:.9375rem;">🔥</span>@endif
                    @if($opp->is_featured)<span title="Featured" style="font-size:.9375rem;">⭐</span>@endif
                </td>

                {{-- Actions --}}
                <td style="padding:.75rem 1rem;">
                    <div style="display:flex;align-items:center;gap:.375rem;">
                        <a href="{{ route('admin.opportunities.show', $opp) }}"
                           style="display:inline-flex;align-items:center;gap:.25rem;color:#6366f1;text-decoration:none;font-size:.75rem;font-weight:600;padding:.3rem .625rem;background:#eef2ff;border-radius:.375rem;"
                           onmouseover="this.style.background='#e0e7ff';" onmouseout="this.style.background='#eef2ff';">
                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Review
                        </a>
                        <a href="{{ route('admin.opportunities.edit', $opp) }}"
                           style="display:inline-flex;align-items:center;gap:.25rem;color:#f97316;text-decoration:none;font-size:.75rem;font-weight:600;padding:.3rem .625rem;background:#fff7ed;border-radius:.375rem;"
                           onmouseover="this.style.background='#fed7aa';" onmouseout="this.style.background='#fff7ed';">
                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.opportunities.destroy', $opp) }}" onsubmit="return confirm('Delete this startup?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="display:inline-flex;align-items:center;gap:.25rem;color:#ef4444;font-size:.75rem;font-weight:600;padding:.3rem .625rem;background:#fef2f2;border-radius:.375rem;border:none;cursor:pointer;" onmouseover="this.style.background='#fecaca';" onmouseout="this.style.background='#fef2f2';">
                                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="padding:3rem;text-align:center;color:#9ca3af;">No startups found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="padding:1rem 1.25rem;border-top:1px solid #f3f4f6;">{{ $opportunities->withQueryString()->links() }}</div>
</div>
@endsection
