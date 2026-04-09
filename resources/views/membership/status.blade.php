@extends('layouts.dashboard')
@section('title', 'Membership Status')
@section('page-title', 'My Membership')

@section('content')
<div class="max-w-3xl space-y-4">
    @forelse($memberships as $m)
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold text-gray-900">{{ $m->plan->name }}</h3>
            <span class="text-xs px-3 py-1 rounded-full font-medium
                {{ $m->status === 'approved' ? 'bg-green-100 text-green-700' :
                   ($m->status === 'rejected' ? 'bg-red-100 text-red-700' :
                   ($m->status === 'revision_required' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700')) }}">
                {{ ucfirst(str_replace('_', ' ', $m->status)) }}
            </span>
        </div>
        <div class="grid grid-cols-2 gap-4 text-sm text-gray-500">
            <div><span class="font-medium text-gray-700">Applied:</span> {{ $m->created_at->format('M d, Y') }}</div>
            @if($m->approved_at)
                <div><span class="font-medium text-gray-700">Approved:</span> {{ $m->approved_at->format('M d, Y') }}</div>
            @endif
            @if($m->expires_at)
                <div><span class="font-medium text-gray-700">Expires:</span> {{ $m->expires_at->format('M d, Y') }}</div>
            @endif
        </div>
        @if($m->admin_notes)
            <div class="mt-3 p-3 bg-amber-50 rounded-lg text-sm text-amber-800">
                <strong>Admin Note:</strong> {{ $m->admin_notes }}
            </div>
        @endif
    </div>
    @empty
    <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
        <p class="text-gray-400 mb-4">No membership applications yet.</p>
        <a href="{{ route('membership.plans') }}" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">
            View Membership Plans
        </a>
    </div>
    @endforelse
</div>
@endsection
