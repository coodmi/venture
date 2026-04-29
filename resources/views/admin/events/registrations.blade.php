@extends('layouts.admin')
@section('title', 'Event Registrations')
@section('page-title', 'Registrations: ' . $event->title)

@section('content')
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
    <div class="p-4 border-b border-gray-200 flex items-center justify-between">
        <p class="text-sm text-gray-500">{{ $registrations->total() }} registrations</p>
        <a href="{{ route('admin.events.index') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">← Back to Events</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Organization</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Registered</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($registrations as $reg)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $reg->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $reg->email }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $reg->organization ?? '—' }}</td>
                    <td class="px-4 py-3">
                        <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $reg->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                            {{ ucfirst($reg->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-400">{{ $reg->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-400">No registrations yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-gray-100">{{ $registrations->links() }}</div>
</div>
@endsection
