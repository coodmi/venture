@extends('layouts.dashboard')
@section('title', 'Seeker Dashboard')
@section('page-title', 'Seeker Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Profile Completion --}}
    @if($profile && $profile->profile_completion < 100)
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-amber-800">Complete your startup profile to attract investors</p>
            <div class="flex items-center gap-3 mt-2">
                <div class="flex-1 bg-amber-200 rounded-full h-2 w-48">
                    <div class="bg-amber-500 h-2 rounded-full" style="width: {{ $profile->profile_completion }}%"></div>
                </div>
                <span class="text-xs text-amber-700 font-medium">{{ $profile->profile_completion }}%</span>
            </div>
        </div>
        <a href="{{ route('seeker.profile.edit') }}" class="bg-amber-500 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-amber-600">
            Complete Profile
        </a>
    </div>
    @endif

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Total Opportunities</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $opportunities->count() }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Approved</p>
            <p class="text-2xl font-bold text-green-600 mt-1">{{ $opportunities->where('status', 'approved')->count() }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Under Review</p>
            <p class="text-2xl font-bold text-amber-600 mt-1">{{ $opportunities->where('status', 'submitted')->count() }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Total Investor Interest</p>
            <p class="text-2xl font-bold text-primary-700 mt-1">{{ array_sum($interestCounts) }}</p>
        </div>
    </div>

    {{-- Opportunities Table --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-gray-900">My Opportunities</h3>
            <a href="{{ route('seeker.opportunities.create') }}" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">
                + Submit New
            </a>
        </div>
        @forelse($opportunities as $opp)
        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
            <div>
                <p class="text-sm font-medium text-gray-900">{{ $opp->title }}</p>
                <p class="text-xs text-gray-400">{{ $opp->sector }} · {{ $opp->stage }}</p>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-xs px-2 py-1 rounded-full font-medium
                    {{ $opp->status === 'approved' ? 'bg-green-100 text-green-700' :
                       ($opp->status === 'submitted' ? 'bg-amber-100 text-amber-700' :
                       ($opp->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600')) }}">
                    {{ ucfirst(str_replace('_', ' ', $opp->status)) }}
                </span>
                <span class="text-xs text-gray-400">{{ $interestCounts[$opp->id] ?? 0 }} interests</span>
                <a href="{{ route('seeker.opportunities.show', $opp) }}" class="text-xs text-primary-600 hover:underline">View</a>
            </div>
        </div>
        @empty
        <div class="text-center py-8">
            <p class="text-gray-400 text-sm mb-3">No opportunities submitted yet.</p>
            <a href="{{ route('seeker.opportunities.create') }}" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">
                Submit Your First Opportunity
            </a>
        </div>
        @endforelse
    </div>

</div>
@endsection
