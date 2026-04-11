@extends('layouts.admin')
@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
<div class="max-w-3xl">
    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 p-8">
        <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:1.25rem;">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Title</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" required
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Event Type</label>
                    <select name="event_type" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        @foreach(['offline', 'online', 'hybrid'] as $t)
                            <option value="{{ $t }}" {{ $event->event_type === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        @foreach(['draft', 'published', 'cancelled', 'completed'] as $s)
                            <option value="{{ $s }}" {{ $event->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Start Date</label>
                    <input type="datetime-local" name="start_date" value="{{ old('start_date', $event->start_date->format('Y-m-d\TH:i')) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Venue</label>
                    <input type="text" name="venue" value="{{ old('venue', $event->venue) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Summary</label>
                <textarea name="summary" rows="2"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('summary', $event->summary) }}</textarea>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Description</label>
                <textarea name="description" rows="6"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('description', $event->description) }}</textarea>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Banner Image</label>
                @if($event->banner)
                    <img src="{{ Storage::url($event->banner) }}" alt="Banner" class="w-32 h-20 object-cover rounded-lg mb-2">
                @endif
                <input type="file" name="banner" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
            </div>
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.5rem 1.5rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;text-decoration:none;display:inline-block;">Update Event</button>
        </form>
    </div>
</div>
@endsection
