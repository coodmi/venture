<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeekerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SeekerProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = SeekerProfile::with('user')->whereHas('user');

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            })->orWhere('company_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('stage')) {
            $query->where('stage', $request->stage);
        }

        if ($request->filled('industry')) {
            $query->where('industry', $request->industry);
        }

        $profiles = $query->latest()->paginate(20);
        return view('admin.startups.index', compact('profiles'));
    }

    public function edit(SeekerProfile $startup)
    {
        $startup->load('user');
        return view('admin.startups.edit', compact('startup'));
    }

    public function update(Request $request, SeekerProfile $startup)
    {
        $startup->load('user');

        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $startup->user->id,
            'phone'            => 'nullable|string|max:20',
            'status'           => 'required|in:active,suspended,pending',
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
            'is_visible'       => 'nullable|boolean',
            'photo'            => 'nullable|image|max:2048',
            'company_logo'     => 'nullable|image|max:2048',
            'password'         => 'nullable|string|min:8',
        ]);

        // Update user account
        $userdata = [
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'status' => $request->status,
        ];
        if ($request->filled('password')) {
            $userdata['password'] = Hash::make($request->password);
        }
        $startup->user->update($userdata);

        // Update profile
        $data = $request->except(['name', 'email', 'phone', 'status', 'password', 'photo', 'company_logo', '_token', '_method']);
        $data['is_visible'] = $request->boolean('is_visible');

        if ($request->hasFile('photo')) {
            if ($startup->photo) Storage::disk('public')->delete($startup->photo);
            $data['photo'] = $request->file('photo')->store('seekers/photos', 'public');
        }

        if ($request->hasFile('company_logo')) {
            if ($startup->company_logo) Storage::disk('public')->delete($startup->company_logo);
            $data['company_logo'] = $request->file('company_logo')->store('seekers/logos', 'public');
        }

        $startup->update($data);

        return back()->with('success', 'Startup profile updated successfully.');
    }
}
