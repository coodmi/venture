@extends('layouts.admin')
@section('title', 'Event Registrations')
@section('page-title', 'Registrations: ' . $event->title)

@section('content')
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="p-4 border-b border-gray-200 flex items-center justify-between">
        <p class="text-sm text-gray-500">{{ $registrations->total() }} registrations</p>
        <a href="{{ route('admin.events.index') }}" class="text-sm text-primary-600 hover:underline">← Back to Events</a>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">Organization</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Registered</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($registrations as $reg)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-900">{{ $reg->name }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $reg->email }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $reg->organization ?? '—' }}</td>
                <td class="px-4 py-3">
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
