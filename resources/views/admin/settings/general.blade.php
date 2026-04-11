@extends('layouts.admin')
@section('title', 'General Settings')
@section('page-title', 'General Settings')

@section('content')
<div class="w-full">
    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:1.5rem;">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
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
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">{{ $field['label'] }}</label>
                    <input type="{{ $field['type'] }}" name="{{ $key }}" value="{{ \App\Models\Setting::get($key) }}"
                           style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem 1rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                </div>
                @endforeach
                <div class="md:col-span-2">
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Favicon</label>
                    <p class="text-xs text-gray-400 mb-2">Recommended: 32x32 or 64x64 .ico / .png file</p>
                    @php $favicon = \App\Models\Setting::get('site_favicon'); @endphp
                    @if($favicon)
                        <img src="{{ Storage::url($favicon) }}" alt="Favicon" class="h-8 w-8 mb-2 rounded">
                    @endif
                    <input type="file" name="site_favicon" accept="image/x-icon,image/png,image/jpeg"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
            </div>
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.5rem 1.5rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;text-decoration:none;display:inline-block;">Save Settings</button>
        </form>
    </div>
</div>
@endsection
