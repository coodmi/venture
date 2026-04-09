<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\InvestorProfile;
use App\Models\SeekerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showInvestorForm()
    {
        return view('auth.register-investor');
    }

    public function showSeekerForm()
    {
        return view('auth.register-seeker');
    }

    public function registerInvestor(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'phone'    => 'nullable|string|max:20',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'status'   => 'pending',
        ]);

        $user->assignRole('investor');

        InvestorProfile::create(['user_id' => $user->id]);

        Auth::login($user);

        return redirect()->route('investor.profile.edit')
            ->with('success', 'Welcome! Please complete your investor profile.');
    }

    public function registerSeeker(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'phone'    => 'nullable|string|max:20',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'status'   => 'pending',
        ]);

        $user->assignRole('seeker');

        SeekerProfile::create(['user_id' => $user->id]);

        Auth::login($user);

        return redirect()->route('seeker.profile.edit')
            ->with('success', 'Welcome! Please complete your startup profile.');
    }
}
