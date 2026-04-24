@extends('layouts.admin')
@section('title', 'About Content')
@section('page-title', 'About Page Content')

@section('content')
@php
    $sectionDefs = [
        'overview'        => ['label' => 'Organization Overview', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => '#6366f1', 'bg' => '#eef2ff'],
        'vision'          => ['label' => 'Vision',                'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z', 'color' => '#8b5cf6', 'bg' => '#f5f3ff'],
        'mission'         => ['label' => 'Mission',               'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'color' => '#10b981', 'bg' => '#ecfdf5'],
        'founder_message' => ['label' => "Founder's Message",     'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z', 'color' => '#f59e0b', 'bg' => '#fffbeb'],
    ];
    $inp = "width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;transition:border-color .15s;";
@endphp

<form method="POST" action="{{ route('admin.settings.about.update') }}" style="display:flex;flex-direction:column;gap:1.25rem;">
    @csrf

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
        @foreach($sectionDefs as $key => $def)
        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);">

            {{-- Card Header --}}
            <div style="padding:.875rem 1.25rem;border-bottom:1px solid #f3f4f6;display:flex;align-items:center;gap:.625rem;">
                <div style="width:2rem;height:2rem;background:{{ $def['bg'] }};border-radius:.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="14" height="14" fill="none" stroke="{{ $def['color'] }}" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $def['icon'] }}"/></svg>
                </div>
                <h4 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0;">{{ $def['label'] }}</h4>
            </div>

            {{-- Card Body --}}
            <div style="padding:1.25rem;display:flex;flex-direction:column;gap:.875rem;">
                <div>
                    <label style="display:block;font-size:.75rem;font-weight:600;color:#374151;margin-bottom:.375rem;">Title / Heading</label>
                    <input type="text" name="sections[{{ $key }}][title]"
                           value="{{ $sections[$key]->title ?? '' }}"
                           placeholder="Enter heading..."
                           style="{{ $inp }}"
                           onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                </div>
                <div>
                    <label style="display:block;font-size:.75rem;font-weight:600;color:#374151;margin-bottom:.375rem;">Content</label>
                    <textarea name="sections[{{ $key }}][content]" rows="5"
                              placeholder="Enter content..."
                              style="{{ $inp }}resize:vertical;"
                              onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">{{ $sections[$key]->content ?? '' }}</textarea>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Save Button --}}
    <div>
        <button type="submit"
                style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-weight:600;padding:.625rem 1.75rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.9375rem;box-shadow:0 2px 8px rgba(99,102,241,.3);transition:all .15s;"
                onmouseover="this.style.background='#4f46e5';this.style.transform='translateY(-1px)';"
                onmouseout="this.style.background='#6366f1';this.style.transform='translateY(0)';">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            Save About Content
        </button>
    </div>
</form>
@endsection
