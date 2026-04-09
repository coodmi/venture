@extends('layouts.admin')
@section('title', 'Events')
@section('page-title', 'Event Management')

@section('content')
<div class="space-y-4">
    <div class="flex justify-end">
        <a href="{{ route('admin.events.create') }}" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">+ Add Event</a>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">Title</th>
                    <th class="px-4 py-3 text-left">Type</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Registrations</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($events as $event)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900 max-w-xs truncate">{{ $event->title }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ ucfirst($event->event_type) }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $event->start_date->format('M d, Y') }}</td>
                    <td class="px-4 py-3">
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $event->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $event->registrations_count }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('admin.events.edit', $event) }}" class="text-primary-600 hover:underline text-xs">Edit</a>
                        <a href="{{ route('admin.events.registrations', $event) }}" class="text-gray-500 hover:underline text-xs">Registrations</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">{{ $events->links() }}</div>
    </div>
</div>
@endsection
