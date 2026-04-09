@extends('layouts.dashboard')
@section('title', $opportunity->title)
@section('page-title', 'Opportunity Details')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $opportunity->title }}</h2>
                <p class="text-sm text-gray-400 mt-1">{{ $opportunity->sector }} · {{ $opportunity->stage }} · {{ $opportunity->location }}</p>
            </div>
            <span class="text-xs px-3 py-1 rounded-full font-medium
                {{ $opportunity->status === 'approved' ? 'bg-green-100 text-green-700' :
                   ($opportunity->status === 'submitted' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600') }}">
                {{ ucfirst(str_replace('_', ' ', $opportunity->status)) }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div>
                <h4 class="font-medium text-gray-700 mb-1">Business Problem</h4>
                <p class="text-gray-600">{{ $opportunity->business_problem }}</p>
            </div>
            <div>
                <h4 class="font-medium text-gray-700 mb-1">Solution</h4>
                <p class="text-gray-600">{{ $opportunity->solution }}</p>
            </div>
            <div>
                <h4 class="font-medium text-gray-700 mb-1">Target Market</h4>
                <p class="text-gray-600">{{ $opportunity->target_market }}</p>
            </div>
            <div>
                <h4 class="font-medium text-gray-700 mb-1">Use of Funds</h4>
                <p class="text-gray-600">{{ $opportunity->use_of_funds }}</p>
            </div>
        </div>

        <div class="mt-4 p-4 bg-primary-50 rounded-xl">
            <span class="text-sm font-medium text-gray-700">Funding Ask: </span>
            <span class="text-lg font-bold text-primary-700">${{ number_format($opportunity->ask_amount) }} {{ $opportunity->ask_currency }}</span>
        </div>
    </div>

    {{-- Investor Interest --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-900 mb-4">Investor Interest ({{ $interests->count() }})</h3>
        @forelse($interests as $interest)
        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
            <div>
                <p class="text-sm font-medium text-gray-900">{{ $interest->investorProfile->user->name }}</p>
                <p class="text-xs text-gray-400">{{ $interest->investorProfile->organization }}</p>
            </div>
            <span class="text-xs bg-primary-50 text-primary-700 px-2 py-1 rounded-full font-medium">
                {{ ucfirst(str_replace('_', ' ', $interest->action)) }}
            </span>
        </div>
        @empty
        <p class="text-sm text-gray-400 text-center py-4">No investor interest yet. Make sure your profile is complete and opportunity is approved.</p>
        @endforelse
    </div>
</div>
@endsection
