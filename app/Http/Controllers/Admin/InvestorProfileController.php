<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class InvestorProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = InvestorProfile::with('user')->whereHas('user');

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            })->orWhere('organization', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('investor_type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('verification_status', $request->status);
        }

        $profiles = $query->latest()->paginate(20);
        return view('admin.investors.index', compact('profiles'));
    }

    public function edit(InvestorProfile $investor)
    {
        $investor->load('user');
        return view('admin.investors.edit', compact('investor'));
    }

    public function update(Request $request, InvestorProfile $investor)
    {
        $investor->load('user');

        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $investor->user->id,
            'phone'            => 'nullable|string|max:20',
            'status'           => 'required|in:active,suspended,pending',
            'investor_type'    => 'nullable|string',
            'organization'     => 'nullable|string|max:255',
            'designation'      => 'nullable|string|max:255',
            'ticket_size_min'  => 'nullable|string',
            'ticket_size_max'  => 'nullable|string',
            'investment_stage' => 'nullable|string',
            'risk_profile'     => 'nullable|string',
            'linkedin_url'     => 'nullable|url',
            'website'          => 'nullable|url',
            'bio'              => 'nullable|string|max:2000',
            'verification_status' => 'nullable|in:pending,verified,rejected',
            'is_visible'       => 'nullable|boolean',
            'photo'            => 'nullable|image|max:2048',
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
        $investor->user->update($userdata);

        // Update profile
        $data = $request->except(['name', 'email', 'phone', 'status', 'password', 'photo', '_token', '_method']);
        $data['sector_preferences']  = $request->input('sector_preferences', []);
        $data['geographic_interest'] = $request->input('geographic_interest', []);
        $data['is_visible']          = $request->boolean('is_visible');

        if ($request->hasFile('photo')) {
            if ($investor->photo) Storage::disk('public')->delete($investor->photo);
            $data['photo'] = $request->file('photo')->store('investors/photos', 'public');
        }

        $investor->update($data);

        return back()->with('success', 'Investor profile updated successfully.');
    }
}
