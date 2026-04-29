@extends('layouts.admin')
@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
        @if($errors->any())
            <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data" class="flex flex-col gap-5">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Event Type</label>
                    <select name="event_type" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        @foreach(['offline', 'online', 'hybrid'] as $t)
                            <option value="{{ $t }}" {{ $event->event_type === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        @foreach(['draft', 'published', 'cancelled', 'completed'] as $s)
                            <option value="{{ $s }}" {{ $event->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Start Date <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="start_date" value="{{ old('start_date', $event->start_date->format('Y-m-d\TH:i')) }}" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">End Date</label>
                    <input type="datetime-local" name="end_date" value="{{ old('end_date', $event->end_date?->format('Y-m-d\TH:i')) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Venue</label>
                    <input type="text" name="venue" value="{{ old('venue', $event->venue) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Max Attendees</label>
                    <input type="number" name="max_attendees" value="{{ old('max_attendees', $event->max_attendees) }}" min="0"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Summary</label>
                <textarea name="summary" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('summary', $event->summary) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
                <textarea name="description" rows="6" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('description', $event->description) }}</textarea>
            </div>
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ $event->is_featured ? 'checked' : '' }} class="rounded border-gray-300">
                    Feature on Homepage
                </label>
                <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                    <input type="checkbox" name="registration_open" value="1" {{ $event->registration_open ? 'checked' : '' }} class="rounded border-gray-300">
                    Registration Open
                </label>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Banner Image</label>
                @if($event->banner)
                    <img src="{{ Storage::url($event->banner) }}" alt="Banner" class="w-32 h-20 object-cover rounded-lg mb-3 border border-gray-200">
                @endif
                <input type="file" name="banner" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
            </div>
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg text-sm transition-colors">
                    Update Event
                </button>
                <a href="{{ route('admin.events.index') }}" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg text-sm transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
