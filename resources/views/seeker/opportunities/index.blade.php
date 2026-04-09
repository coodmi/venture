@extends('layouts.dashboard')
@section('title', 'My Opportunities')
@section('page-title', 'My Opportunities')

@section('content')
<div class="space-y-4">
    <div class="flex justify-end">
        <a href="{{ route('seeker.opportunities.create') }}" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">
            + Submit New Opportunity
        </a>
    </div>

    @forelse($opportunities as $opp)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="font-semibold text-gray-900">{{ $opp->title }}</h3>
                <p class="text-sm text-gray-400 mt-0.5">{{ $opp->sector }} · {{ $opp->stage }} · ${{ number_format($opp->ask_amount) }}</p>
                <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $opp->solution }}</p>
            </div>
            <div class="flex flex-col items-end gap-2 ml-4">
                <span class="text-xs px-2 py-1 rounded-full font-medium
                    {{ $opp->status === 'approved' ? 'bg-green-100 text-green-700' :
                       ($opp->status === 'submitted' ? 'bg-amber-100 text-amber-700' :
                       ($opp->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600')) }}">
                    {{ ucfirst(str_replace('_', ' ', $opp->status)) }}
                </span>
                <div class="flex gap-2">
                    <a href="{{ route('seeker.opportunities.show', $opp) }}" class="text-xs text-primary-600 hover:underline">View</a>
                    @if(in_array($opp->status, ['draft', 'revision_required']))
                        <a href="{{ route('seeker.opportunities.edit', $opp) }}" class="text-xs text-gray-500 hover:underline">Edit</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
        <p class="text-gray-400 mb-4">No opportunities submitted yet.</p>
        <a href="{{ route('seeker.opportunities.create') }}" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">
            Submit Your First Opportunity
        </a>
    </div>
    @endforelse

    {{ $opportunities->links() }}
</div>
@endsection
