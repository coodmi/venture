@extends('layouts.admin')
@section('title', 'About Content')
@section('page-title', 'About Page Content')

@section('content')
<div class="w-full">
    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.settings.about.update') }}" style="display:flex;flex-direction:column;gap:1.5rem;">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                   style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Content</label>
                            <textarea name="sections[{{ $key }}][content]" rows="4"
                                      style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">{{ $sections[$key]->content ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.5rem 1.5rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;text-decoration:none;display:inline-block;">Save About Content</button>
        </form>
    </div>
</div>
@endsection
