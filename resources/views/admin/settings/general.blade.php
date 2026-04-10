@extends('layouts.admin')
@section('title', 'General Settings')
@section('page-title', 'General Settings')

@section('content')
<div class="max-w-2xl space-y-4">
    <div class="flex gap-3 mb-6">
        <a href="{{ route('admin.settings.general') }}" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg">General</a>
        <a href="{{ route('admin.settings.header') }}" class="border border-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50">Header</a>
        <a href="{{ route('admin.settings.stats') }}" class="border border-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50">Platform Stats</a>
        <a href="{{ route('admin.settings.testimonials') }}" class="border border-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50">Testimonials</a>
        <a href="{{ route('admin.settings.about') }}" class="border border-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50">About Content</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
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
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Site Logo</label>
                @php $logo = \App\Models\Setting::get('site_logo'); @endphp
                @if($logo)
                    <img src="{{ Storage::url($logo) }}" alt="Logo" class="h-10 mb-2">
                @endif
                <input type="file" name="site_logo" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
            </div>
            <button type="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">Save Settings</button>
        </form>
    </div>
</div>
@endsection
