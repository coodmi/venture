@extends('layouts.admin')
@section('title', 'Startup Categories')
@section('page-title', 'Startup Categories')

@section('content')
<div style="max-width:600px;">
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,.04);margin-bottom:1.5rem;">
        <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Add New Category</h3>
        <form method="POST" action="{{ route('admin.startup-categories.store') }}" style="display:flex;gap:.75rem;">
            @csrf
            <input type="text" name="name" placeholder="e.g. BioTech" required
                style="flex:1;background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;">
            <button type="submit"
                style="background:#6366f1;color:#fff;font-weight:600;padding:.5rem 1.25rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;">
                Add
            </button>
        </form>
        @error('name')<p style="color:#ef4444;font-size:.8rem;margin:.375rem 0 0;">{{ $message }}</p>@enderror
    </div>

    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
        <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Current Categories</h3>
        @if(count($sectors))
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.5rem;">
            @foreach($sectors as $sector)
            <li style="display:flex;align-items:center;justify-content:space-between;padding:.5rem .75rem;background:#f9fafb;border:1px solid #e5e7eb;border-radius:.5rem;">
                <span style="font-size:.875rem;color:#111827;">{{ $sector }}</span>
                <form method="POST" action="{{ route('admin.startup-categories.destroy', urlencode($sector)) }}" onsubmit="return confirm('Remove this category?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="background:none;border:none;color:#ef4444;cursor:pointer;font-size:.8rem;font-weight:600;">Remove</button>
                </form>
            </li>
            @endforeach
        </ul>
        @else
        <p style="color:#9ca3af;font-size:.875rem;">No categories yet.</p>
        @endif
    </div>
</div>
@endsection
