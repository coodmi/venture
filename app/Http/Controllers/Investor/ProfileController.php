<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\InvestorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user    = Auth::user();
        $profile = $user->investorProfile ?? InvestorProfile::create(['user_id' => $user->id]);
        return view('investor.profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'investor_type'   => 'nullable|string',
            'organization'    => 'nullable|string|max:255',
            'designation'     => 'nullable|string|max:255',
            'ticket_size_min' => 'nullable|string',
            'ticket_size_max' => 'nullable|string',
            'investment_stage'=> 'nullable|string',
            'risk_profile'    => 'nullable|string',
            'linkedin_url'    => 'nullable|url',
            'website'         => 'nullable|url',
            'bio'             => 'nullable|string|max:2000',
            'photo'           => 'nullable|image|max:2048',
        ]);

        $user    = Auth::user();
        $profile = $user->investorProfile;

        $data = $request->except(['photo', '_token', '_method']);
        $data['sector_preferences']  = $request->input('sector_preferences', []);
        $data['geographic_interest'] = $request->input('geographic_interest', []);

        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $data['photo'] = $request->file('photo')->store('investors/photos', 'public');
        }

        $data['profile_completion'] = $this->calculateCompletion($data);
        $profile->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    private function calculateCompletion(array $data): int
    {
        $fields = ['investor_type', 'organization', 'designation', 'bio', 'linkedin_url', 'ticket_size_min', 'investment_stage'];
        $filled = collect($fields)->filter(fn($f) => !empty($data[$f]))->count();
        return (int) round(($filled / count($fields)) * 100);
    }
}
