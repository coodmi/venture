@extends('layouts.dashboard')
@section('title', 'Edit Opportunity')
@section('page-title', 'Edit Opportunity')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-gray-200 p-8">
        <form method="POST" action="{{ route('seeker.opportunities.update', $opportunity) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $opportunity->title) }}" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sector</label>
                    <select name="sector" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        @foreach(['Technology', 'FinTech', 'HealthTech', 'EdTech', 'AgriTech', 'CleanTech', 'E-Commerce', 'Real Estate', 'Manufacturing', 'Logistics', 'Media', 'Other'] as $s)
                            <option value="{{ $s }}" {{ $opportunity->sector === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stage</label>
                    <select name="stage" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        @foreach(['Idea', 'MVP', 'Early Stage', 'Growth', 'Scale'] as $s)
                            <option value="{{ $s }}" {{ $opportunity->stage === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Funding Ask (USD)</label>
                    <input type="number" name="ask_amount" value="{{ old('ask_amount', $opportunity->ask_amount) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" name="location" value="{{ old('location', $opportunity->location) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Business Problem</label>
                <textarea name="business_problem" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('business_problem', $opportunity->business_problem) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Solution</label>
                <textarea name="solution" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('solution', $opportunity->solution) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Target Market</label>
                <textarea name="target_market" rows="2"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('target_market', $opportunity->target_market) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Use of Funds</label>
                <textarea name="use_of_funds" rows="2"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('use_of_funds', $opportunity->use_of_funds) }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" name="action" value="draft" class="border border-gray-300 text-gray-700 font-medium px-6 py-2.5 rounded-lg hover:bg-gray-50 text-sm">Save Draft</button>
                <button type="submit" name="action" value="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">Submit for Review</button>
            </div>
        </form>
    </div>
</div>
@endsection
