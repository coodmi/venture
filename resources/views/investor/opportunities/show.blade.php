@extends('layouts.dashboard')
@section('title', $opportunity->title)
@section('page-title', 'Opportunity Details')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <div class="flex items-start justify-between mb-4">
            <div>
                <div class="flex gap-2 mb-2">
                    <span class="bg-primary-50 text-primary-700 text-xs font-semibold px-2 py-1 rounded-full">{{ $opportunity->stage }}</span>
                    @if($opportunity->is_hot_deal)
                        <span class="bg-red-50 text-red-600 text-xs font-semibold px-2 py-1 rounded-full">🔥 Hot Deal</span>
                    @endif
                    @if($opportunity->is_featured)
                        <span class="bg-amber-50 text-amber-600 text-xs font-semibold px-2 py-1 rounded-full">⭐ Featured</span>
                    @endif
                </div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $opportunity->title }}</h2>
                <p class="text-sm text-gray-400 mt-1">{{ $opportunity->sector }} · {{ $opportunity->location }}</p>
            </div>
            <div class="text-right">
                <p class="text-2xl font-extrabold text-primary-700">${{ number_format($opportunity->ask_amount) }}</p>
                <p class="text-xs text-gray-400">{{ $opportunity->ask_currency }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm mb-6">
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Business Problem</h4>
                <p class="text-gray-600 leading-relaxed">{{ $opportunity->business_problem }}</p>
            </div>
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Solution</h4>
                <p class="text-gray-600 leading-relaxed">{{ $opportunity->solution }}</p>
            </div>
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Target Market</h4>
                <p class="text-gray-600 leading-relaxed">{{ $opportunity->target_market }}</p>
            </div>
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Use of Funds</h4>
                <p class="text-gray-600 leading-relaxed">{{ $opportunity->use_of_funds }}</p>
            </div>
            @if($opportunity->traction)
            <div class="md:col-span-2">
                <h4 class="font-semibold text-gray-700 mb-2">Traction & Key Metrics</h4>
                <p class="text-gray-600 leading-relaxed">{{ $opportunity->traction }}</p>
            </div>
            @endif
        </div>

        @if($opportunity->pitch_deck)
        <div class="mb-6">
            <a href="{{ Storage::url($opportunity->pitch_deck) }}" target="_blank"
               class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-200">
                📄 Download Pitch Deck
            </a>
        </div>
        @endif

        {{-- Action Buttons --}}
        <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-100">
            @foreach(['saved' => '🔖 Save', 'interested' => '✅ Express Interest', 'meeting_requested' => '📅 Request Meeting', 'shortlisted' => '⭐ Shortlist'] as $action => $label)
            <form method="POST" action="{{ route('investor.opportunities.action', $opportunity) }}">
                @csrf
                <input type="hidden" name="action" value="{{ $action }}">
                <button type="submit" class="border border-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                    {{ $label }}
                </button>
            </form>
            @endforeach
        </div>
    </div>

    {{-- Seeker Info --}}
    @if($opportunity->seekerProfile)
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-900 mb-3">About the Company</h3>
        <div class="flex items-center gap-4">
            @if($opportunity->seekerProfile->company_logo)
                <img src="{{ Storage::url($opportunity->seekerProfile->company_logo) }}" alt="Logo" class="w-12 h-12 object-contain">
            @endif
            <div>
                <p class="font-medium text-gray-900">{{ $opportunity->seekerProfile->company_name }}</p>
                <p class="text-sm text-gray-500">{{ $opportunity->seekerProfile->industry }} · {{ $opportunity->seekerProfile->location }}</p>
                @if($opportunity->seekerProfile->website)
                    <a href="{{ $opportunity->seekerProfile->website }}" target="_blank" class="text-xs text-primary-600 hover:underline">{{ $opportunity->seekerProfile->website }}</a>
                @endif
            </div>
        </div>
        @if($opportunity->seekerProfile->business_summary)
            <p class="text-sm text-gray-600 mt-3">{{ $opportunity->seekerProfile->business_summary }}</p>
        @endif
    </div>
    @endif
</div>
@endsection
