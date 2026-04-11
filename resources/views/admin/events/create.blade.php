@extends('layouts.admin')
@section('title', 'Add Event')
@section('page-title', 'Add Event')

@section('content')
<div class="max-w-3xl">
    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 p-8">
        <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:1.25rem;">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Event Type <span class="text-red-500">*</span></label>
                    <select name="event_type" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        <option value="offline">Offline</option>
                        <option value="online">Online</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Category</label>
                    <input type="text" name="category" value="{{ old('category') }}"
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Start Date <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="start_date" value="{{ old('start_date') }}" required
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">End Date</label>
                    <input type="datetime-local" name="end_date" value="{{ old('end_date') }}"
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Venue</label>
                    <input type="text" name="venue" value="{{ old('venue') }}"
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Summary</label>
                <textarea name="summary" rows="2"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('summary') }}</textarea>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Description</label>
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
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Banner Image</label>
                <input type="file" name="banner" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
            </div>
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.5rem 1.5rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;text-decoration:none;display:inline-block;">Save Event</button>
        </form>
    </div>
</div>
@endsection
