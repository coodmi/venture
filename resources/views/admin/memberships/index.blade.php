@extends('layouts.admin')
@section('title', 'Memberships')
@section('page-title', 'Membership Applications')

@section('content')
<div style="background:#1a1408;" class=" rounded-xl border border-gray-200 overflow-hidden">
    <div style="padding:1rem;border-bottom:1px solid rgba(212,146,15,.12);">
        <form method="GET" style="display:flex;gap:.75rem;">
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">All Status</option>
                @foreach(['submitted', 'under_review', 'approved', 'rejected', 'revision_required'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-primary-600 text-white text-sm px-4 py-2 rounded-lg">Filter</button>
            <a href="{{ route('admin.memberships.plans') }}" class="border border-gray-300 text-gray-700 text-sm px-4 py-2 rounded-lg hover:bg-gray-50">Manage Plans</a>
        </form>
    </div>
    <table style="width:100%;font-size:.875rem;border-collapse:collapse;">
        <thead style="background:#110e05;" style="background:#110e05;">
            <tr>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Applicant</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Plan</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Status</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Applied</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Actions</th>
            </tr>
        </thead>
        <tbody >
            @foreach($memberships as $m)
            <tr onmouseover="this.style.background='rgba(212,146,15,.04)';" onmouseout="this.style.background='transparent';">
                <td style="padding:.75rem 1rem;border-bottom:1px solid rgba(212,146,15,.06);">
                    <p class="font-medium text-gray-900">{{ $m->user->name }}</p>
                    <p style="font-size:.75rem;color:#6b5c3e;">{{ $m->user->email }}</p>
                </td>
                <td class="px-4 py-3 text-gray-600">{{ $m->plan->name }}</td>
                <td style="padding:.75rem 1rem;border-bottom:1px solid rgba(212,146,15,.06);">
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                        {{ $m->status === 'approved' ? 'bg-green-100 text-green-700' :
                           ($m->status === 'rejected' ? 'bg-red-100 text-red-700' :
                           ($m->status === 'revision_required' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700')) }}">
                        {{ ucfirst(str_replace('_', ' ', $m->status)) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-gray-400">{{ $m->created_at->format('M d, Y') }}</td>
                <td style="padding:.75rem 1rem;border-bottom:1px solid rgba(212,146,15,.06);">
                    <a href="{{ route('admin.memberships.show', $m) }}" style="color:#d4920f;text-decoration:none;font-size:.75rem;font-weight:600;">Review</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $memberships->links() }}</div>
</div>
@endsection
