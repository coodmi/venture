@extends('layouts.admin')
@section('title', 'Opportunities')
@section('page-title', 'Opportunity Management')

@section('content')
<div style="background:#1a1408;" class=" rounded-xl border border-gray-200 overflow-hidden">
    <div style="padding:1rem;border-bottom:1px solid rgba(212,146,15,.12);">
        <form method="GET" style="display:flex;gap:.75rem;">
            <select name="status" style="background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#c9b48a;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;">
                <option value="">All Status</option>
                @foreach(['draft', 'submitted', 'under_review', 'approved', 'rejected', 'archived'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                @endforeach
            </select>
            <select name="sector" style="background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#c9b48a;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;">
                <option value="">All Sectors</option>
                @foreach(['Technology', 'FinTech', 'HealthTech', 'EdTech', 'AgriTech', 'CleanTech', 'E-Commerce', 'Real Estate', 'Manufacturing', 'Logistics', 'Media', 'Other'] as $s)
                    <option value="{{ $s }}" {{ request('sector') === $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-primary-600 text-white text-sm px-4 py-2 rounded-lg">Filter</button>
        </form>
    </div>
    <table style="width:100%;font-size:.875rem;border-collapse:collapse;">
        <thead style="background:#110e05;" style="background:#110e05;">
            <tr>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Title</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Seeker</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Sector</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Ask</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Status</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Flags</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Actions</th>
            </tr>
        </thead>
        <tbody >
            @foreach($opportunities as $opp)
            <tr onmouseover="this.style.background='rgba(212,146,15,.04)';" onmouseout="this.style.background='transparent';">
                <td style="padding:.75rem 1rem;font-weight:600;color:#f0e6c8;max-width:16rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;border-bottom:1px solid rgba(212,146,15,.06);">{{ $opp->title }}</td>
                <td style="padding:.75rem 1rem;color:#7a6a4a;border-bottom:1px solid rgba(212,146,15,.06);">{{ $opp->user->name }}</td>
                <td style="padding:.75rem 1rem;color:#7a6a4a;border-bottom:1px solid rgba(212,146,15,.06);">{{ $opp->sector }}</td>
                <td style="padding:.75rem 1rem;font-weight:700;color:#d4920f;border-bottom:1px solid rgba(212,146,15,.06);">${{ number_format($opp->ask_amount) }}</td>
                <td style="padding:.75rem 1rem;border-bottom:1px solid rgba(212,146,15,.06);">
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                        {{ $opp->status === 'approved' ? 'bg-green-100 text-green-700' :
                           ($opp->status === 'submitted' ? 'bg-amber-100 text-amber-700' :
                           ($opp->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600')) }}">
                        {{ ucfirst(str_replace('_', ' ', $opp->status)) }}
                    </span>
                </td>
                <td style="padding:.75rem 1rem;border-bottom:1px solid rgba(212,146,15,.06);">
                    @if($opp->is_hot_deal)<span class="text-xs">🔥</span>@endif
                    @if($opp->is_featured)<span class="text-xs">⭐</span>@endif
                </td>
                <td style="padding:.75rem 1rem;border-bottom:1px solid rgba(212,146,15,.06);">
                    <a href="{{ route('admin.opportunities.show', $opp) }}" style="color:#d4920f;text-decoration:none;font-size:.75rem;font-weight:600;">Review</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $opportunities->links() }}</div>
</div>
@endsection
