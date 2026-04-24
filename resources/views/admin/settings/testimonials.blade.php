@extends('layouts.admin')
@section('title', 'Testimonials')
@section('page-title', 'Manage Testimonials')

@section('content')
@php $inp="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;"; $lbl="display:block;font-size:.8125rem;font-weight:600;color:#374151;margin-bottom:.375rem;"; @endphp
<div style="display:flex;flex-direction:column;gap:1.5rem;">
    <div style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <h3 style="font-weight:700;color:#0d2b6e;margin:0 0 1.25rem;font-size:.9375rem;">Add Testimonial</h3>
        <form method="POST" action="{{ route('admin.settings.testimonials.store') }}" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:1rem;">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div><label style="{{ $lbl }}">Name *</label><input type="text" name="name" required style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';"></div>
                <div><label style="{{ $lbl }}">Designation</label><input type="text" name="designation" style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';"></div>
                <div><label style="{{ $lbl }}">Organization</label><input type="text" name="organization" style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';"></div>
                <div><label style="{{ $lbl }}">Photo</label><input type="file" name="photo" accept="image/*" style="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;border-radius:.5rem;padding:.4rem .75rem;font-size:.875rem;box-sizing:border-box;"></div>
            </div>
            <div><label style="{{ $lbl }}">Testimonial *</label><textarea name="content" rows="3" required style="{{ $inp }}resize:vertical;"></textarea></div>
            <div style="display:flex;align-items:center;gap:.75rem;">
                <label style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:#374151;cursor:pointer;">
                    <input type="checkbox" name="is_published" value="1" checked style="accent-color:#1a3c8f;">
                    Publish immediately
                </label>
                <button type="submit" style="background:#f97316;color:#fff;font-weight:700;padding:.5rem 1.25rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;">Add Testimonial</button>
            </div>
        </form>
    </div>

    <div style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <h3 style="font-weight:700;color:#0d2b6e;margin:0 0 1rem;font-size:.9375rem;">Existing Testimonials ({{ $testimonials->count() }})</h3>
        <div style="display:flex;flex-direction:column;gap:.75rem;">
            @foreach($testimonials as $t)
            <div style="display:flex;align-items:flex-start;gap:.875rem;padding:1rem;background:#f4f7fb;border-radius:.75rem;border:1px solid #dde3ea;">
                <div style="flex:1;">
                    <p style="font-size:.875rem;font-weight:600;color:#0d2b6e;margin:0 0 .2rem;">{{ $t->name }}</p>
                    <p style="font-size:.75rem;color:#8d98a1;margin:0 0 .5rem;">{{ $t->designation }} · {{ $t->organization }}</p>
                    <p style="font-size:.8125rem;color:#374151;margin:0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">"{{ $t->content }}"</p>
                </div>
                <span style="font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;white-space:nowrap;{{ $t->is_published?'background:#f0fdf4;color:#16a34a;':'background:#f1f5f9;color:#8d98a1;' }}">
                    {{ $t->is_published?'Published':'Draft' }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
