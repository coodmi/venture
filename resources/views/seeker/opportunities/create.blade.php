@extends('layouts.dashboard')
@section('title', 'Submit Opportunity')
@section('page-title', 'Submit Opportunity')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-gray-200 p-8">
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('seeker.opportunities.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Opportunity Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sector <span class="text-red-500">*</span></label>
                    <select name="sector" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">Select sector</option>
                        @foreach(['Technology', 'FinTech', 'HealthTech', 'EdTech', 'AgriTech', 'CleanTech', 'E-Commerce', 'Real Estate', 'Manufacturing', 'Logistics', 'Media', 'Other'] as $s)
                            <option value="{{ $s }}" {{ old('sector') === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Business Stage <span class="text-red-500">*</span></label>
                    <select name="stage" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">Select stage</option>
                        @foreach(['Idea', 'MVP', 'Early Stage', 'Growth', 'Scale'] as $s)
                            <option value="{{ $s }}" {{ old('stage') === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Funding Ask (USD) <span class="text-red-500">*</span></label>
                    <input type="number" name="ask_amount" value="{{ old('ask_amount') }}" required min="1"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Business Problem <span class="text-red-500">*</span></label>
                <textarea name="business_problem" rows="3" required
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('business_problem') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Your Solution <span class="text-red-500">*</span></label>
                <textarea name="solution" rows="3" required
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('solution') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Target Market <span class="text-red-500">*</span></label>
                <textarea name="target_market" rows="2" required
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('target_market') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Traction / Key Metrics</label>
                <textarea name="traction" rows="2"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('traction') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Use of Funds <span class="text-red-500">*</span></label>
                <textarea name="use_of_funds" rows="2" required
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('use_of_funds') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pitch Deck (PDF/PPT, max 20MB)</label>
                <input type="file" name="pitch_deck" accept=".pdf,.ppt,.pptx"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" name="action" value="draft" class="border border-gray-300 text-gray-700 font-medium px-6 py-2.5 rounded-lg hover:bg-gray-50 text-sm">
                    Save as Draft
                </button>
                <button type="submit" name="action" value="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">
                    Submit for Review
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
