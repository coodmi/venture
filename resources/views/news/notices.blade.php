@extends('layouts.app')
@section('title', 'Notices')

@section('content')
<section class="bg-gradient-to-br from-primary-950 to-primary-800 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Official Notices</h1>
    </div>
</section>
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 space-y-4">
        @forelse($notices as $notice)
        <div class="bg-white rounded-xl border {{ $notice->importance_level === 'urgent' ? 'border-red-300' : 'border-gray-200' }} p-5">
            @if($notice->importance_level === 'urgent')
                <span class="bg-red-100 text-red-700 text-xs font-semibold px-2 py-0.5 rounded-full">🚨 Urgent</span>
            @endif
            <h3 class="font-semibold text-gray-900 mt-2">{{ $notice->title }}</h3>
            <p class="text-sm text-gray-500 mt-1">{{ $notice->summary }}</p>
            <p class="text-xs text-gray-400 mt-2">{{ $notice->published_at?->format('M d, Y') }}</p>
        </div>
        @empty
        <div class="text-center py-16 text-gray-400">No notices at the moment.</div>
        @endforelse
        {{ $notices->links() }}
    </div>
</section>
@endsection
