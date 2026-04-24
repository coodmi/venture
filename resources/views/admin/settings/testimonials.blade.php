@extends('layouts.admin')
@section('title', 'Testimonials')
@section('page-title', 'Manage Testimonials')

@section('content')
@php
    $inp = "width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;transition:border-color .15s;";
    $lbl = "display:block;font-size:.8125rem;font-weight:600;color:#374151;margin-bottom:.375rem;";
@endphp

<div style="display:grid;grid-template-columns:1fr 1.5fr;gap:1.25rem;align-items:start;">

    {{-- Left: Add Form --}}
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);">
        <div style="padding:1rem 1.25rem;border-bottom:1px solid #f3f4f6;background:linear-gradient(135deg,#6366f1,#8b5cf6);">
            <h3 style="font-weight:700;color:#fff;margin:0;font-size:.9375rem;display:flex;align-items:center;gap:.5rem;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Add Testimonial
            </h3>
        </div>
        <div style="padding:1.25rem;">
            <form method="POST" action="{{ route('admin.settings.testimonials.store') }}" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:1rem;">
                @csrf
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;">
                    <div>
                        <label style="{{ $lbl }}">Name <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="name" required style="{{ $inp }}"
                               onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Designation</label>
                        <input type="text" name="designation" style="{{ $inp }}"
                               onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Organization</label>
                        <input type="text" name="organization" style="{{ $inp }}"
                               onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Photo</label>
                        <input type="file" name="photo" accept="image/*"
                               style="width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#6b7280;border-radius:.5rem;padding:.4rem .75rem;font-size:.875rem;box-sizing:border-box;cursor:pointer;">
                    </div>
                </div>
                <div>
                    <label style="{{ $lbl }}">Testimonial <span style="color:#ef4444;">*</span></label>
                    <textarea name="content" rows="4" required
                              style="{{ $inp }}resize:vertical;"
                              onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';"></textarea>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;">
                    <label style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:#374151;cursor:pointer;">
                        <input type="checkbox" name="is_published" value="1" checked style="accent-color:#6366f1;width:1rem;height:1rem;">
                        Publish immediately
                    </label>
                    <button type="submit"
                            style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-weight:600;padding:.5rem 1.25rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;box-shadow:0 2px 8px rgba(99,102,241,.3);transition:all .15s;"
                            onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Add Testimonial
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Right: Existing Testimonials --}}
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);">
        <div style="padding:1rem 1.25rem;border-bottom:1px solid #f3f4f6;display:flex;align-items:center;justify-content:space-between;">
            <h3 style="font-weight:700;color:#111827;margin:0;font-size:.9375rem;">Existing Testimonials</h3>
            <span style="background:#eef2ff;color:#6366f1;font-size:.75rem;font-weight:700;padding:.2rem .625rem;border-radius:9999px;">{{ $testimonials->count() }}</span>
        </div>
        <div style="padding:1.25rem;display:flex;flex-direction:column;gap:.75rem;max-height:600px;overflow-y:auto;">
            @forelse($testimonials as $t)
            <div style="display:flex;align-items:flex-start;gap:.875rem;padding:1rem;background:#f8fafc;border-radius:.75rem;border:1px solid #f3f4f6;transition:border-color .15s;"
                 onmouseover="this.style.borderColor='#e5e7eb';" onmouseout="this.style.borderColor='#f3f4f6';">
                <div style="width:2.5rem;height:2.5rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span style="color:#fff;font-weight:700;font-size:.875rem;">{{ strtoupper(substr($t->name,0,1)) }}</span>
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.25rem;">
                        <p style="font-size:.875rem;font-weight:600;color:#111827;margin:0;">{{ $t->name }}</p>
                        <span style="font-size:.65rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;white-space:nowrap;{{ $t->is_published?'background:#ecfdf5;color:#059669;':'background:#f3f4f6;color:#6b7280;' }}">
                            {{ $t->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                    <p style="font-size:.75rem;color:#9ca3af;margin:0 0 .5rem;">{{ $t->designation }}@if($t->organization) · {{ $t->organization }}@endif</p>
                    <p style="font-size:.8125rem;color:#374151;margin:0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;font-style:italic;">"{{ $t->content }}"</p>
                </div>
            </div>
            @empty
            <div style="text-align:center;padding:2.5rem 1rem;">
                <div style="width:3rem;height:3rem;background:#f3f4f6;border-radius:1rem;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;">
                    <svg width="20" height="20" fill="none" stroke="#9ca3af" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                </div>
                <p style="font-size:.875rem;color:#9ca3af;margin:0;">No testimonials yet.</p>
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
