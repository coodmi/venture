@extends('layouts.admin')
@section('title', 'Add Article')
@section('page-title', 'Add News / Article')

@section('content')
<div class="max-w-3xl">
    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 p-8">
        <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:1.25rem;">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Type</label>
                    <select name="type" style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                        @foreach(['news', 'notice', 'press_release', 'newsletter'] as $t)
                            <option value="{{ $t }}" {{ old('type') === $t ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $t)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Category</label>
                    <input type="text" name="category" value="{{ old('category') }}" placeholder="e.g. Investment, Startup"
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Author</label>
                    <input type="text" name="author" value="{{ old('author', auth()->user()->name) }}"
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Status</label>
                    <select name="status" style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Summary</label>
                <textarea name="summary" rows="2"
                          style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">{{ old('summary') }}</textarea>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Body <span class="text-red-500">*</span></label>
                <textarea name="body" rows="10" required
                          style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">{{ old('body') }}</textarea>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Cover Image</label>
                <input type="file" name="cover_image" accept="image/*"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
            </div>
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.5rem 1.5rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;text-decoration:none;display:inline-block;">
                Save Article
            </button>
        </form>
    </div>
</div>
@endsection
