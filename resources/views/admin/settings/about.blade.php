@extends('layouts.admin')
@section('title', 'About Content')
@section('page-title', 'About Page Content')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.settings.about.update') }}" class="space-y-6">
            @csrf
            @php
                $sectionDefs = [
                    'overview'        => 'Organization Overview',
                    'vision'          => 'Vision',
                    'mission'         => 'Mission',
                    'founder_message' => "Founder's Message",
                ];
            @endphp
            @foreach($sectionDefs as $key => $label)
            <div class="border border-gray-200 rounded-xl p-5">
                <h4 class="font-medium text-gray-900 mb-3">{{ $label }}</h4>
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Title / Heading</label>
                        <input type="text" name="sections[{{ $key }}][title]"
                               value="{{ $sections[$key]->title ?? '' }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Content</label>
                        <textarea name="sections[{{ $key }}][content]" rows="4"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ $sections[$key]->content ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            @endforeach
            <button type="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">Save About Content</button>
        </form>
    </div>
</div>
@endsection
