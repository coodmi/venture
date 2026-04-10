@extends('layouts.app')
@section('title', 'Apply for ' . $plan->name)

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl border border-gray-200 p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Apply for {{ $plan->name }}</h1>
        <p class="text-gray-500 mb-6">{{ $plan->description }}</p>

        <form method="POST" action="{{ route('membership.store', $plan->slug) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Organization / Company</label>
                <input type="text" name="organization" value="{{ old('organization') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Designation / Role</label>
                <input type="text" name="designation" value="{{ old('designation') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Why do you want to join?</label>
                <textarea name="interests" rows="4"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('interests') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Supporting Documents (optional)</label>
                <input type="file" name="documents[]" multiple accept=".pdf,.doc,.docx,.jpg,.png"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                <p class="text-xs text-gray-400 mt-1">PDF, DOC, or images. Max 5MB each.</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 text-sm text-gray-600">
                <strong>Plan Fee:</strong>
                @if($plan->fee > 0)
                    ৳{{ number_format($plan->fee) }} / {{ $plan->duration_months }} months
                @else
                    Free
                @endif
            </div>

            <button type="submit" class="w-full bg-primary-600 text-white font-semibold py-3 rounded-xl hover:bg-primary-700 transition-colors">
                Submit Application
            </button>
        </form>
    </div>
</div>
@endsection
