@extends('layouts.admin')
@section('title', 'General Settings')
@section('page-title', 'General Settings')

@section('content')
<div class="w-full">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
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
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $field['label'] }}</label>
                    <input type="{{ $field['type'] }}" name="{{ $key }}" value="{{ \App\Models\Setting::get($key) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                @endforeach
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Favicon</label>
                    <p class="text-xs text-gray-400 mb-2">Recommended: 32x32 or 64x64 .ico / .png file</p>
                    @php $favicon = \App\Models\Setting::get('site_favicon'); @endphp
                    @if($favicon)
                        <img src="{{ Storage::url($favicon) }}" alt="Favicon" class="h-8 w-8 mb-2 rounded">
                    @endif
                    <input type="file" name="site_favicon" accept="image/x-icon,image/png,image/jpeg"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
            </div>
            <button type="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">Save Settings</button>
        </form>
    </div>
</div>
@endsection
