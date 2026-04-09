@extends('layouts.admin')
@section('title', 'Add Event')
@section('page-title', 'Add Event')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-gray-200 p-8">
        <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Type <span class="text-red-500">*</span></label>
                    <select name="event_type" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        <option value="offline">Offline</option>
                        <option value="online">Online</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <input type="text" name="category" value="{{ old('category') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Date <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="start_date" value="{{ old('start_date') }}" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <input type="datetime-local" name="end_date" value="{{ old('end_date') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Venue</label>
                    <input type="text" name="venue" value="{{ old('venue') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Summary</label>
                <textarea name="summary" rows="2"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('summary') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="6"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('description') }}</textarea>
            </div>
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-gray-300 text-primary-600">
                    Feature on Homepage
                </label>
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="registration_open" value="1" checked class="rounded border-gray-300 text-primary-600">
                    Registration Open
                </label>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Banner Image</label>
                <input type="file" name="banner" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
            </div>
            <button type="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">Save Event</button>
        </form>
    </div>
</div>
@endsection
