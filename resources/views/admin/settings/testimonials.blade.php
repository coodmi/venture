@extends('layouts.admin')
@section('title', 'Testimonials')
@section('page-title', 'Manage Testimonials')

@section('content')
<div class="w-full space-y-6">
    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 p-6">
        <h3 style="font-weight:700;color:#f0e6c8;margin-bottom:1rem;">Add Testimonial</h3>
        <form method="POST" action="{{ route('admin.settings.testimonials.store') }}" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:1rem;">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Designation</label>
                    <input type="text" name="designation" style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Organization</label>
                    <input type="text" name="organization" style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Photo</label>
                    <input type="file" name="photo" accept="image/*" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                </div>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Testimonial <span class="text-red-500">*</span></label>
                <textarea name="content" rows="3" required style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;"></textarea>
            </div>
            <div style="display:flex;align-items:center;gap:.75rem;">
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="is_published" value="1" checked class="rounded border-gray-300 text-primary-600">
                    Publish immediately
                </label>
                <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.5rem 1rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;text-decoration:none;display:inline-block;">Add Testimonial</button>
            </div>
        </form>
    </div>

    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 p-6">
        <h3 style="font-weight:700;color:#f0e6c8;margin-bottom:1rem;">Existing Testimonials ({{ $testimonials->count() }})</h3>
        <div class="space-y-3">
            @foreach($testimonials as $t)
            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">{{ $t->name }}</p>
                    <p style="font-size:.75rem;color:#6b5c3e;">{{ $t->designation }} · {{ $t->organization }}</p>
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
