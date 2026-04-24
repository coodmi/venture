@extends('layouts.admin')
@section('title', 'Events')
@section('page-title', 'Event Management')

@section('content')
<div style="display:flex;flex-direction:column;gap:1rem;">

    {{-- Add Event Button --}}
    <div style="display:flex;justify-content:flex-end;">
        <a href="{{ route('admin.events.create') }}"
           style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;box-shadow:0 2px 8px rgba(99,102,241,.3);transition:all .15s;"
           onmouseover="this.style.background='#4f46e5';this.style.transform='translateY(-1px)';"
           onmouseout="this.style.background='#6366f1';this.style.transform='translateY(0)';">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Event
        </a>
    </div>

    {{-- Table Card --}}
    <div style="background:#fff;border-radius:.875rem;border:1px solid #e5e7eb;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);">
        <table style="width:100%;font-size:.875rem;border-collapse:collapse;">
            <thead style="background:#f8fafc;">
                <tr>
                    @foreach(['Title','Type','Date','Status','Registrations','Actions'] as $h)
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #f3f4f6;">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr style="border-bottom:1px solid #f9fafb;transition:background .1s;"
                    onmouseover="this.style.background='#f8fafc';" onmouseout="this.style.background='transparent';">
                    <td style="padding:.75rem 1rem;font-weight:600;color:#111827;max-width:18rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $event->title }}</td>
                    <td style="padding:.75rem 1rem;">
                        <span style="background:#f3f4f6;color:#374151;font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;">{{ ucfirst($event->event_type) }}</span>
                    </td>
                    <td style="padding:.75rem 1rem;color:#6b7280;font-size:.8125rem;">{{ $event->start_date->format('M d, Y') }}</td>
                    <td style="padding:.75rem 1rem;">
                        <span style="font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;
                            {{ $event->status === 'published' ? 'background:#ecfdf5;color:#059669;' :
                               ($event->status === 'draft' ? 'background:#f3f4f6;color:#6b7280;' : 'background:#fff7ed;color:#d97706;') }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </td>
                    <td style="padding:.75rem 1rem;">
                        <span style="display:inline-flex;align-items:center;gap:.25rem;color:#6b7280;font-size:.8125rem;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $event->registrations_count }}
                        </span>
                    </td>
                    <td style="padding:.75rem 1rem;">
                        <div style="display:flex;align-items:center;gap:.5rem;">
                            <a href="{{ route('admin.events.edit', $event) }}"
                               style="display:inline-flex;align-items:center;gap:.25rem;color:#6b7280;text-decoration:none;font-size:.8125rem;font-weight:600;padding:.25rem .625rem;background:#f3f4f6;border-radius:.375rem;transition:background .15s;"
                               onmouseover="this.style.background='#e5e7eb';" onmouseout="this.style.background='#f3f4f6';">
                                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            <a href="{{ route('admin.events.registrations', $event) }}"
                               style="display:inline-flex;align-items:center;gap:.25rem;color:#6366f1;text-decoration:none;font-size:.8125rem;font-weight:600;padding:.25rem .625rem;background:#eef2ff;border-radius:.375rem;transition:background .15s;"
                               onmouseover="this.style.background='#e0e7ff';" onmouseout="this.style.background='#eef2ff';">
                                Registrations
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding:1rem 1.25rem;border-top:1px solid #f3f4f6;">{{ $events->links() }}</div>
    </div>
</div>
@endsection
