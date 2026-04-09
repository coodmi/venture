@extends('layouts.dashboard')
@section('title', 'Edit Investor Profile')
@section('page-title', 'My Investor Profile')

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

        {{-- Profile Completion --}}
        <div class="mb-6 p-4 bg-gray-50 rounded-xl">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Profile Completion</span>
                <span class="text-sm font-bold text-primary-700">{{ $profile->profile_completion }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-primary-600 h-2 rounded-full transition-all" style="width: {{ $profile->profile_completion }}%"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('investor.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Investor Type</label>
                    <select name="investor_type" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">Select type</option>
                        @foreach(['Angel Investor', 'Venture Capital', 'Corporate Investor', 'Family Office', 'Private Equity', 'Impact Investor'] as $t)
                            <option value="{{ $t }}" {{ $profile->investor_type === $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Organization</label>
                    <input type="text" name="organization" value="{{ old('organization', $profile->organization) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                    <input type="text" name="designation" value="{{ old('designation', $profile->designation) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Investment Stage</label>
                    <select name="investment_stage" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">Select stage</option>
                        @foreach(['Pre-Seed', 'Seed', 'Series A', 'Series B', 'Growth', 'Any Stage'] as $s)
                            <option value="{{ $s }}" {{ $profile->investment_stage === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Min Ticket Size (USD)</label>
                    <input type="text" name="ticket_size_min" value="{{ old('ticket_size_min', $profile->ticket_size_min) }}" placeholder="e.g. 50000"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Max Ticket Size (USD)</label>
                    <input type="text" name="ticket_size_max" value="{{ old('ticket_size_max', $profile->ticket_size_max) }}" placeholder="e.g. 500000"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $profile->linkedin_url) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                    <input type="url" name="website" value="{{ old('website', $profile->website) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bio / About</label>
                <textarea name="bio" rows="4"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('bio', $profile->bio) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Profile Photo</label>
                @if($profile->photo)
                    <img src="{{ Storage::url($profile->photo) }}" alt="Profile" class="w-16 h-16 rounded-full object-cover mb-2">
                @endif
                <input type="file" name="photo" accept="image/*"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
            </div>

            <button type="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">
                Save Profile
            </button>
        </form>
    </div>
</div>
@endsection
