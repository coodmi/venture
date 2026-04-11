@extends('layouts.admin')
@section('title', 'General Settings')
@section('page-title', 'General Settings')

@section('content')
<div style="max-width:56rem;">
    <div style="background:#1a1408;border:1px solid rgba(212,146,15,.15);border-radius:1rem;padding:1.75rem;">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:1.5rem;">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
                @php
                    $fields = [
                        'site_name'    => ['label' => 'Site Name',    'type' => 'text'],
                        'site_tagline' => ['label' => 'Tagline',      'type' => 'text'],
                        'site_email'   => ['label' => 'Contact Email','type' => 'email'],
                        'site_phone'   => ['label' => 'Phone',        'type' => 'text'],
                        'site_address' => ['label' => 'Address',      'type' => 'text'],
                        'facebook_url' => ['label' => 'Facebook URL', 'type' => 'url'],
                        'twitter_url'  => ['label' => 'Twitter URL',  'type' => 'url'],
                        'linkedin_url' => ['label' => 'LinkedIn URL', 'type' => 'url'],
                    ];
                @endphp
                @foreach($fields as $key => $field)
                <div>
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">{{ $field['label'] }}</label>
                    <input type="{{ $field['type'] }}" name="{{ $key }}" value="{{ \App\Models\Setting::get($key) }}"
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.625rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;"
                           onfocus="this.style.borderColor='rgba(212,146,15,.6)';" onblur="this.style.borderColor='rgba(212,146,15,.2)';">
                </div>
                @endforeach

                {{-- Favicon --}}
                <div style="grid-column:1/-1;">
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Favicon</label>
                    <p style="font-size:.75rem;color:#6b5c3e;margin:0 0 .625rem;">Recommended: 32×32 or 64×64 .ico / .png</p>
                    @php $favicon = \App\Models\Setting::get('site_favicon'); @endphp
                    @if($favicon)
                        <img src="{{ Storage::url($favicon) }}" alt="Favicon" style="width:2rem;height:2rem;border-radius:.375rem;margin-bottom:.625rem;display:block;">
                    @endif
                    <input type="file" name="site_favicon" accept="image/x-icon,image/png,image/jpeg"
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#9a8a6a;border-radius:.5rem;padding:.5rem .875rem;font-size:.875rem;box-sizing:border-box;">
                </div>
            </div>

            <div>
                <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.625rem 1.75rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.9375rem;">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
