@extends('layouts.admin')
@section('title', 'Events')
@section('page-title', 'Event Management')

@section('content')
<div style="display:flex;flex-direction:column;gap:1rem;">
    <div class="flex justify-end">
        <a href="{{ route('admin.events.create') }}" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">+ Add Event</a>
    </div>
    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 overflow-hidden">
        <table style="width:100%;font-size:.875rem;border-collapse:collapse;">
            <thead style="background:#110e05;" style="background:#110e05;">
                <tr>
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Title</th>
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Type</th>
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Date</th>
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Status</th>
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Registrations</th>
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Actions</th>
                </tr>
            </thead>
            <tbody >
                @foreach($events as $event)
                <tr onmouseover="this.style.background='rgba(212,146,15,.04)';" onmouseout="this.style.background='transparent';">
                    <td style="padding:.75rem 1rem;font-weight:600;color:#f0e6c8;max-width:16rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;border-bottom:1px solid rgba(212,146,15,.06);">{{ $event->title }}</td>
                    <td style="padding:.75rem 1rem;color:#7a6a4a;border-bottom:1px solid rgba(212,146,15,.06);">{{ ucfirst($event->event_type) }}</td>
                    <td style="padding:.75rem 1rem;color:#7a6a4a;border-bottom:1px solid rgba(212,146,15,.06);">{{ $event->start_date->format('M d, Y') }}</td>
                    <td style="padding:.75rem 1rem;border-bottom:1px solid rgba(212,146,15,.06);">
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $event->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </td>
                    <td style="padding:.75rem 1rem;color:#7a6a4a;border-bottom:1px solid rgba(212,146,15,.06);">{{ $event->registrations_count }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('admin.events.edit', $event) }}" style="color:#d4920f;text-decoration:none;font-size:.75rem;font-weight:600;">Edit</a>
                        <a href="{{ route('admin.events.registrations', $event) }}" style="color:#d4920f;text-decoration:none;font-size:.75rem;font-weight:600;">Registrations</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">{{ $events->links() }}</div>
    </div>
</div>
@endsection
