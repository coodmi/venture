@extends('layouts.admin')
@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-gray-200 p-8">
        <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Type</label>
                    <select name="event_type" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        @foreach(['offline', 'online', 'hybrid'] as $t)
                            <option value="{{ $t }}" {{ $event->event_type === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        @foreach(['draft', 'published', 'cancelled', 'completed'] as $s)
                            <option value="{{ $s }}" {{ $event->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                    <input type="datetime-local" name="start_date" value="{{ old('start_date', $event->start_date->format('Y-m-d\TH:i')) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Venue</label>
                    <input type="text" name="venue" value="{{ old('venue', $event->venue) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Summary</label>
                <textarea name="summary" rows="2"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('summary', $event->summary) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="6"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('description', $event->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Banner Image</label>
                @if($event->banner)
                    <img src="{{ Storage::url($event->banner) }}" alt="Banner" class="w-32 h-20 object-cover rounded-lg mb-2">
                @endif
                <input type="file" name="banner" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
            </div>
            <button type="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">Update Event</button>
        </form>
    </div>
</div>
@endsection
