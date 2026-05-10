@extends('layouts.admin')
@section('title', 'Popup Settings')
@section('page-title', 'Welcome Popup Settings')

@section('content')
@php
    $inp = "width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;border-radius:.5rem;padding:.625rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;";
    $lbl = "display:block;font-size:.8125rem;font-weight:600;color:#374151;margin-bottom:.375rem;";
@endphp
<div style="max-width:56rem;">
    <div style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.75rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <form method="POST" action="{{ route('admin.settings.popup.update') }}" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:1.5rem;">
            @csrf

            {{-- Enable / Disable --}}
            <div style="background:#f4f7fb;border:1px solid #dde3ea;border-radius:.75rem;padding:1.25rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;">
                <div>
                    <p style="font-weight:700;color:#0d2b6e;margin:0 0 .2rem;">Enable Welcome Popup</p>
                    <p style="font-size:.8125rem;color:#8d98a1;margin:0;">Show the popup to visitors on the home page.</p>
                </div>
                <label style="position:relative;display:inline-block;width:3rem;height:1.625rem;flex-shrink:0;">
                    <input type="checkbox" name="popup_enabled" value="1" {{ \App\Models\Setting::get('popup_enabled','1')==='1'?'checked':'' }} style="opacity:0;width:0;height:0;">
                    <span onclick="this.previousElementSibling.checked=!this.previousElementSibling.checked;this.style.background=this.previousElementSibling.checked?'#1a3c8f':'#d1d5db';"
                          style="position:absolute;cursor:pointer;inset:0;border-radius:9999px;background:{{ \App\Models\Setting::get('popup_enabled','1')==='1'?'#1a3c8f':'#d1d5db' }};transition:.3s;">
                        <span style="position:absolute;height:1.25rem;width:1.25rem;left:.1875rem;bottom:.1875rem;background:#fff;border-radius:50%;transition:.3s;"></span>
                    </span>
                </label>
            </div>

            {{-- Left Image --}}
            <div>
                <label style="{{ $lbl }}">Left Side Image</label>
                <p style="font-size:.75rem;color:#8d98a1;margin:0 0 .625rem;">Recommended: portrait/tall image (e.g. 600×800px). If not set, a gradient with your logo is shown.</p>
                @php $popupImage = \App\Models\Setting::get('popup_image'); @endphp
                @if($popupImage)
                <div style="margin-bottom:.875rem;display:flex;align-items:center;gap:1rem;">
                    <img src="{{ Storage::url($popupImage) }}" alt="Popup Image" style="height:8rem;width:auto;border-radius:.75rem;object-fit:cover;border:1px solid #dde3ea;">
                    <a href="{{ route('admin.settings.popup.remove-image') }}" onclick="return confirm('Remove popup image?')" style="font-size:.8125rem;color:#ef4444;text-decoration:none;">✕ Remove</a>
                </div>
                @endif
                <input type="file" name="popup_image" accept="image/*" style="{{ $inp }} padding:.5rem .875rem;">
            </div>

            {{-- Badge --}}
            <div>
                <label style="{{ $lbl }}">Badge Text</label>
                <input type="text" name="popup_badge" value="{{ \App\Models\Setting::get('popup_badge','Investment Platform') }}" style="{{ $inp }}" placeholder="e.g. Investment Platform" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
            </div>

            {{-- Title --}}
            <div>
                <label style="{{ $lbl }}">Title</label>
                <p style="font-size:.75rem;color:#8d98a1;margin:0 0 .5rem;">The site name is automatically appended in blue after the title.</p>
                <input type="text" name="popup_title" value="{{ \App\Models\Setting::get('popup_title','Welcome to') }}" style="{{ $inp }}" placeholder="e.g. Welcome to" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
            </div>

            {{-- Description --}}
            <div>
                <label style="{{ $lbl }}">Description</label>
                <textarea name="popup_desc" rows="3" style="{{ $inp }} resize:vertical;" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">{{ \App\Models\Setting::get('popup_desc',"Connecting investors, founders, and ecosystem stakeholders on Bangladesh's leading venture platform.") }}</textarea>
            </div>

            {{-- Button 1 --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div>
                    <label style="{{ $lbl }}">Button 1 Text (Primary)</label>
                    <input type="text" name="popup_btn1_text" value="{{ \App\Models\Setting::get('popup_btn1_text','Explore Opportunities') }}" style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                </div>
                <div>
                    <label style="{{ $lbl }}">Button 1 URL</label>
                    <input type="text" name="popup_btn1_url" value="{{ \App\Models\Setting::get('popup_btn1_url','/startups') }}" style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                </div>
            </div>

            {{-- Button 2 --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div>
                    <label style="{{ $lbl }}">Button 2 Text (Secondary)</label>
                    <input type="text" name="popup_btn2_text" value="{{ \App\Models\Setting::get('popup_btn2_text','Join as Investor or Startup') }}" style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                </div>
                <div>
                    <label style="{{ $lbl }}">Button 2 URL</label>
                    <input type="text" name="popup_btn2_url" value="{{ \App\Models\Setting::get('popup_btn2_url','/register/investor') }}" style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                </div>
            </div>

            <div>
                <button type="submit" style="background:#1a3c8f;color:#fff;font-weight:700;padding:.625rem 1.75rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.9375rem;">Save Popup Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
