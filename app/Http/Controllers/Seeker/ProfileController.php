<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\SeekerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user    = Auth::user();
        $profile = $user->seekerProfile ?? SeekerProfile::create(['user_id' => $user->id]);
        return view('seeker.profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name'     => 'nullable|string|max:255',
            'industry'         => 'nullable|string',
            'stage'            => 'nullable|string',
            'team_size'        => 'nullable|integer|min:1',
            'location'         => 'nullable|string|max:255',
            'country'          => 'nullable|string|max:100',
            'website'          => 'nullable|url',
            'linkedin_url'     => 'nullable|url',
            'twitter_url'      => 'nullable|url',
            'business_summary' => 'nullable|string|max:3000',
            'photo'            => 'nullable|image|max:2048',
            'company_logo'     => 'nullable|image|max:2048',
        ]);

        $user    = Auth::user();
        $profile = $user->seekerProfile;
        $data    = $request->except(['photo', 'company_logo', '_token', '_method']);

        if ($request->hasFile('photo')) {
            if ($profile->photo) Storage::disk('public')->delete($profile->photo);
            $data['photo'] = $request->file('photo')->store('seekers/photos', 'public');
        }

        if ($request->hasFile('company_logo')) {
            if ($profile->company_logo) Storage::disk('public')->delete($profile->company_logo);
            $data['company_logo'] = $request->file('company_logo')->store('seekers/logos', 'public');
        }

        $data['profile_completion'] = $this->calculateCompletion($data);
        $profile->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    private function calculateCompletion(array $data): int
    {
        $fields = ['company_name', 'industry', 'stage', 'location', 'website', 'business_summary', 'team_size'];
        $filled = collect($fields)->filter(fn($f) => !empty($data[$f]))->count();
        return (int) round(($filled / count($fields)) * 100);
    }
}
