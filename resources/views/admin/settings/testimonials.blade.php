@extends('layouts.admin')
@section('title', 'Testimonials')
@section('page-title', 'Manage Testimonials')

@section('content')
<div class="w-full space-y-6">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-900 mb-4">Add Testimonial</h3>
        <form method="POST" action="{{ route('admin.settings.testimonials.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                    <input type="text" name="designation" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Organization</label>
                    <input type="text" name="organization" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                    <input type="file" name="photo" accept="image/*" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Testimonial <span class="text-red-500">*</span></label>
                <textarea name="content" rows="3" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500"></textarea>
            </div>
            <div class="flex items-center gap-3">
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="is_published" value="1" checked class="rounded border-gray-300 text-primary-600">
                    Publish immediately
                </label>
                <button type="submit" class="bg-primary-600 text-white font-medium px-4 py-2 rounded-lg hover:bg-primary-700 text-sm">Add Testimonial</button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-900 mb-4">Existing Testimonials ({{ $testimonials->count() }})</h3>
        <div class="space-y-3">
            @foreach($testimonials as $t)
            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">{{ $t->name }}</p>
                    <p class="text-xs text-gray-400">{{ $t->designation }} · {{ $t->organization }}</p>
                    <p class="text-sm text-gray-600 mt-1 line-clamp-2">"{{ $t->content }}"</p>
                </div>
                <span class="text-xs px-2 py-0.5 rounded-full {{ $t->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                    {{ $t->is_published ? 'Published' : 'Draft' }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
