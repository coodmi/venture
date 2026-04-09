<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index(Request $request)
    {
        $query = Membership::with(['user', 'plan']);
        if ($request->filled('status')) $query->where('status', $request->status);
        $memberships = $query->latest()->paginate(20);
        return view('admin.memberships.index', compact('memberships'));
    }

    public function show(Membership $membership)
    {
        $membership->load(['user', 'plan']);
        return view('admin.memberships.show', compact('membership'));
    }

    public function updateStatus(Request $request, Membership $membership)
    {
        $request->validate([
            'status'      => 'required|in:approved,rejected,under_review,revision_required',
            'admin_notes' => 'nullable|string',
        ]);

        $data = ['status' => $request->status, 'admin_notes' => $request->admin_notes];

        if ($request->status === 'approved') {
            $data['approved_at'] = now();
            $data['expires_at']  = now()->addMonths($membership->plan->duration_months);
        }

        $membership->update($data);
        return back()->with('success', 'Membership status updated.');
    }

    public function plans()
    {
        $plans = MembershipPlan::orderBy('sort_order')->get();
        return view('admin.memberships.plans', compact('plans'));
    }
}
