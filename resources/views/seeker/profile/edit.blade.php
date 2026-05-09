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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Founder / Profile Photo</label>
                    <div style="display:flex;align-items:center;gap:1rem;">
                        <div style="position:relative;flex-shrink:0;">
                            @if($profile->photo)
                                <img id="photoPreview" src="{{ Storage::url($profile->photo) }}" alt="Photo"
                                     style="width:5rem;height:5rem;border-radius:50%;object-fit:cover;border:3px solid #e0e7ff;display:block;">
                            @else
                                <div id="photoPreview" style="width:5rem;height:5rem;border-radius:50%;background:linear-gradient(135deg,#f97316,#fb923c);display:flex;align-items:center;justify-content:center;border:3px solid #fed7aa;">
                                    <span style="color:#fff;font-weight:800;font-size:1.5rem;">{{ strtoupper(substr($user->name,0,1)) }}</span>
                                </div>
                            @endif
                            <label for="photoInput" style="position:absolute;bottom:0;right:0;width:1.625rem;height:1.625rem;background:#6366f1;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.2);">
                                <svg width="12" height="12" fill="none" stroke="#fff" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><circle cx="12" cy="13" r="3"/></svg>
                            </label>
                        </div>
                        <div>
                            <p style="font-size:.8125rem;font-weight:600;color:#374151;margin:0 0 .25rem;">{{ $user->name }}</p>
                            <p style="font-size:.75rem;color:#9ca3af;margin:0 0 .5rem;">Click the camera icon to change</p>
                            <input type="file" id="photoInput" name="photo" accept="image/*" style="display:none;" onchange="previewImage(this,'photoPreview')">
                            <label for="photoInput" style="display:inline-flex;align-items:center;gap:.375rem;font-size:.75rem;font-weight:600;color:#6366f1;cursor:pointer;padding:.3rem .75rem;background:#eef2ff;border-radius:.5rem;">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                Upload Photo
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Logo</label>
                    <div style="display:flex;align-items:center;gap:1rem;">
                        <div style="position:relative;flex-shrink:0;">
                            @if($profile->company_logo)
                                <img id="logoPreview" src="{{ Storage::url($profile->company_logo) }}" alt="Logo"
                                     style="width:5rem;height:5rem;border-radius:.75rem;object-fit:contain;border:2px solid #e5e7eb;background:#f9fafb;padding:.25rem;display:block;">
                            @else
                                <div id="logoPreview" style="width:5rem;height:5rem;border-radius:.75rem;background:#f3f4f6;border:2px dashed #d1d5db;display:flex;align-items:center;justify-content:center;">
                                    <svg width="24" height="24" fill="none" stroke="#9ca3af" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <label for="logoInput" style="position:absolute;bottom:0;right:0;width:1.625rem;height:1.625rem;background:#f97316;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.2);">
                                <svg width="12" height="12" fill="none" stroke="#fff" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><circle cx="12" cy="13" r="3"/></svg>
                            </label>
                        </div>
                        <div>
                            <p style="font-size:.8125rem;font-weight:600;color:#374151;margin:0 0 .25rem;">{{ $profile->company_name ?: 'Company Logo' }}</p>
                            <p style="font-size:.75rem;color:#9ca3af;margin:0 0 .5rem;">PNG, JPG — max 2MB</p>
                            <input type="file" id="logoInput" name="company_logo" accept="image/*" style="display:none;" onchange="previewImage(this,'logoPreview')">
                            <label for="logoInput" style="display:inline-flex;align-items:center;gap:.375rem;font-size:.75rem;font-weight:600;color:#f97316;cursor:pointer;padding:.3rem .75rem;background:#fff7ed;border-radius:.5rem;">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                Upload Logo
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            @push('scripts')
            <script>
            function previewImage(input, previewId) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var el = document.getElementById(previewId);
                        if (el.tagName === 'IMG') {
                            el.src = e.target.result;
                        } else {
                            // Replace div with img
                            var img = document.createElement('img');
                            img.id = previewId;
                            img.src = e.target.result;
                            img.style.cssText = el.style.cssText;
                            img.style.objectFit = 'cover';
                            el.parentNode.replaceChild(img, el);
                        }
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            </script>
            @endpush

            <button type="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">
                Save Profile
            </button>
        </form>
    </div>
</div>
@endsection
