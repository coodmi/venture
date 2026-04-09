@extends('layouts.admin')
@section('title', $opportunity->title)
@section('page-title', 'Review Opportunity')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $opportunity->title }}</h2>
                <p class="text-sm text-gray-400">{{ $opportunity->sector }} · {{ $opportunity->stage }} · {{ $opportunity->location }}</p>
                <p class="text-sm text-gray-500 mt-1">Submitted by: <strong>{{ $opportunity->user->name }}</strong></p>
            </div>
            <span class="text-xs px-3 py-1 rounded-full font-medium
                {{ $opportunity->status === 'approved' ? 'bg-green-100 text-green-700' :
                   ($opportunity->status === 'submitted' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600') }}">
                {{ ucfirst(str_replace('_', ' ', $opportunity->status)) }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-sm mb-6">
            <div><h4 class="font-medium text-gray-700 mb-1">Business Problem</h4><p class="text-gray-600">{{ $opportunity->business_problem }}</p></div>
            <div><h4 class="font-medium text-gray-700 mb-1">Solution</h4><p class="text-gray-600">{{ $opportunity->solution }}</p></div>
            <div><h4 class="font-medium text-gray-700 mb-1">Target Market</h4><p class="text-gray-600">{{ $opportunity->target_market }}</p></div>
            <div><h4 class="font-medium text-gray-700 mb-1">Use of Funds</h4><p class="text-gray-600">{{ $opportunity->use_of_funds }}</p></div>
        </div>

        <div class="p-4 bg-primary-50 rounded-xl mb-6">
            <span class="text-sm font-medium text-gray-700">Funding Ask: </span>
            <span class="text-lg font-bold text-primary-700">${{ number_format($opportunity->ask_amount) }}</span>
        </div>

        {{-- Status Actions --}}
        <div class="flex flex-wrap gap-3">
            @foreach(['approved', 'rejected', 'under_review'] as $status)
            <form method="POST" action="{{ route('admin.opportunities.status', $opportunity) }}">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="{{ $status }}">
                <button type="submit" class="text-sm font-medium px-4 py-2 rounded-lg border
                    {{ $status === 'approved' ? 'bg-green-600 text-white border-green-600 hover:bg-green-700' :
                       ($status === 'rejected' ? 'bg-red-600 text-white border-red-600 hover:bg-red-700' : 'border-gray-300 text-gray-700 hover:bg-gray-50') }}">
                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                </button>
            </form>
            @endforeach

            <form method="POST" action="{{ route('admin.opportunities.featured', $opportunity) }}">
                @csrf @method('PATCH')
                <button type="submit" class="text-sm font-medium px-4 py-2 rounded-lg border {{ $opportunity->is_featured ? 'bg-amber-500 text-white border-amber-500' : 'border-gray-300 text-gray-700 hover:bg-gray-50' }}">
                    {{ $opportunity->is_featured ? '⭐ Featured' : 'Mark Featured' }}
                </button>
            </form>

            <form method="POST" action="{{ route('admin.opportunities.hot-deal', $opportunity) }}">
                @csrf @method('PATCH')
                <button type="submit" class="text-sm font-medium px-4 py-2 rounded-lg border {{ $opportunity->is_hot_deal ? 'bg-red-500 text-white border-red-500' : 'border-gray-300 text-gray-700 hover:bg-gray-50' }}">
                    {{ $opportunity->is_hot_deal ? '🔥 Hot Deal' : 'Mark Hot Deal' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
