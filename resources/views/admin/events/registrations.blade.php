@extends('layouts.admin')
@section('title', 'Event Registrations')
@section('page-title', 'Registrations: ' . $event->title)

@section('content')
<div style="background:#1a1408;" class=" rounded-xl border border-gray-200 overflow-hidden">
    <div class="p-4 border-b border-gray-200 flex items-center justify-between">
        <p style="font-size:.875rem;color:#7a6a4a;">{{ $registrations->total() }} registrations</p>
        <a href="{{ route('admin.events.index') }}" style="color:#d4920f;text-decoration:none;font-weight:600;font-size:.8125rem;">← Back to Events</a>
    </div>
    <table style="width:100%;font-size:.875rem;border-collapse:collapse;">
        <thead style="background:#110e05;" style="background:#110e05;">
            <tr>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Name</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Email</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Organization</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Status</th>
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Registered</th>
            </tr>
        </thead>
        <tbody >
            @foreach($registrations as $reg)
            <tr onmouseover="this.style.background='rgba(212,146,15,.04)';" onmouseout="this.style.background='transparent';">
                <td class="px-4 py-3 font-medium text-gray-900">{{ $reg->name }}</td>
                <td style="padding:.75rem 1rem;color:#7a6a4a;border-bottom:1px solid rgba(212,146,15,.06);">{{ $reg->email }}</td>
                <td style="padding:.75rem 1rem;color:#7a6a4a;border-bottom:1px solid rgba(212,146,15,.06);">{{ $reg->organization ?? '—' }}</td>
                <td style="padding:.75rem 1rem;border-bottom:1px solid rgba(212,146,15,.06);">
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $reg->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ ucfirst($reg->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-gray-400">{{ $reg->created_at->format('M d, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $registrations->links() }}</div>
</div>
@endsection
