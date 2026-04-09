<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function plans()
    {
        $plans = MembershipPlan::where('is_active', true)->where('is_public', true)->orderBy('sort_order')->get();
        return view('membership.plans', compact('plans'));
    }

    public function apply(MembershipPlan $plan)
    {
        return view('membership.apply', compact('plan'));
    }

    public function store(Request $request, MembershipPlan $plan)
    {
        $request->validate([
            'organization' => 'nullable|string|max:255',
            'designation'  => 'nullable|string|max:255',
            'interests'    => 'nullable|string',
            'documents.*'  => 'nullable|file|max:5120',
        ]);

        $documents = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $documents[] = $file->store('memberships/docs', 'public');
            }
        }

        Membership::create([
            'user_id'            => Auth::id(),
            'membership_plan_id' => $plan->id,
            'status'             => 'submitted',
            'application_data'   => $request->except(['documents', '_token']),
            'documents'          => $documents,
        ]);

        return redirect()->route('membership.status')
            ->with('success', 'Membership application submitted successfully.');
    }

    public function status()
    {
        $memberships = Auth::user()->memberships()->with('plan')->latest()->get();
        return view('membership.status', compact('memberships'));
    }
}
