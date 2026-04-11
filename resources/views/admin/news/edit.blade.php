@extends('layouts.admin')
@section('title', 'Edit Article')
@section('page-title', 'Edit Article')

@section('content')
<div class="max-w-3xl">
    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 p-8">
        <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:1.25rem;">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Title</label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" required
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Type</label>
                    <select name="type" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        @foreach(['news', 'notice', 'press_release', 'newsletter'] as $t)
                            <option value="{{ $t }}" {{ $news->type === $t ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $t)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        <option value="draft" {{ $news->status === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $news->status === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ $news->status === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Summary</label>
                <textarea name="summary" rows="2"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('summary', $news->summary) }}</textarea>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Body</label>
                <textarea name="body" rows="10"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('body', $news->body) }}</textarea>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Cover Image</label>
                @if($news->cover_image)
                    <img src="{{ Storage::url($news->cover_image) }}" alt="Cover" class="w-32 h-20 object-cover rounded-lg mb-2">
                @endif
                <input type="file" name="cover_image" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
            </div>
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.5rem 1.5rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;text-decoration:none;display:inline-block;">Update Article</button>
        </form>
    </div>
</div>
@endsection
