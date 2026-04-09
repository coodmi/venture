@extends('layouts.dashboard')
@section('title', 'Edit Startup Profile')
@section('page-title', 'My Startup Profile')

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

        <div class="mb-6 p-4 bg-gray-50 rounded-xl">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Profile Completion</span>
                <span class="text-sm font-bold text-primary-700">{{ $profile->profile_completion }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-primary-600 h-2 rounded-full" style="width: {{ $profile->profile_completion }}%"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('seeker.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $profile->company_name) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                    <select name="industry" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">Select industry</option>
                        @foreach(['Technology', 'FinTech', 'HealthTech', 'EdTech', 'AgriTech', 'CleanTech', 'E-Commerce', 'Real Estate', 'Manufacturing', 'Logistics', 'Media', 'Other'] as $i)
                            <option value="{{ $i }}" {{ $profile->industry === $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Business Stage</label>
                    <select name="stage" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">Select stage</option>
                        @foreach(['Idea', 'MVP', 'Early Stage', 'Growth', 'Scale'] as $s)
                            <option value="{{ $s }}" {{ $profile->stage === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Team Size</label>
                    <input type="number" name="team_size" value="{{ old('team_size', $profile->team_size) }}" min="1"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location / City</label>
                    <input type="text" name="location" value="{{ old('location', $profile->location) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                    <input type="text" name="country" value="{{ old('country', $profile->country) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                    <input type="url" name="website" value="{{ old('website', $profile->website) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $profile->linkedin_url) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Business Summary</label>
                <textarea name="business_summary" rows="4"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('business_summary', $profile->business_summary) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Founder Photo</label>
                    @if($profile->photo)
                        <img src="{{ Storage::url($profile->photo) }}" alt="Photo" class="w-16 h-16 rounded-full object-cover mb-2">
                    @endif
                    <input type="file" name="photo" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Company Logo</label>
                    @if($profile->company_logo)
                        <img src="{{ Storage::url($profile->company_logo) }}" alt="Logo" class="w-16 h-16 object-contain mb-2">
                    @endif
                    <input type="file" name="company_logo" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
            </div>

            <button type="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">
                Save Profile
            </button>
        </form>
    </div>
</div>
@endsection
