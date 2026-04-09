@extends('layouts.admin')
@section('title', 'Edit Article')
@section('page-title', 'Edit Article')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-gray-200 p-8">
        <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select name="type" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        @foreach(['news', 'notice', 'press_release', 'newsletter'] as $t)
                            <option value="{{ $t }}" {{ $news->type === $t ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $t)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        <option value="draft" {{ $news->status === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $news->status === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ $news->status === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Summary</label>
                <textarea name="summary" rows="2"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('summary', $news->summary) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Body</label>
                <textarea name="body" rows="10"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('body', $news->body) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cover Image</label>
                @if($news->cover_image)
                    <img src="{{ Storage::url($news->cover_image) }}" alt="Cover" class="w-32 h-20 object-cover rounded-lg mb-2">
                @endif
                <input type="file" name="cover_image" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
            </div>
            <button type="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">Update Article</button>
        </form>
    </div>
</div>
@endsection
