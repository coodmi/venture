<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    public function index(Request $request)
    {
        $query = Opportunity::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('sector')) {
            $query->where('sector', $request->sector);
        }

        $opportunities = $query->latest()->paginate(20);
        return view('admin.opportunities.index', compact('opportunities'));
    }

    public function show(Opportunity $opportunity)
    {
        $opportunity->load(['user', 'seekerProfile', 'interests.investorProfile.user']);
        return view('admin.opportunities.show', compact('opportunity'));
    }

    public function updateStatus(Request $request, Opportunity $opportunity)
    {
        $request->validate(['status' => 'required|in:approved,rejected,under_review,archived']);
        $opportunity->update(['status' => $request->status]);
        return back()->with('success', 'Opportunity status updated.');
    }

    public function toggleFeatured(Opportunity $opportunity)
    {
        $opportunity->update(['is_featured' => !$opportunity->is_featured]);
        return back()->with('success', 'Featured status toggled.');
    }

    public function toggleHotDeal(Opportunity $opportunity)
    {
        $opportunity->update(['is_hot_deal' => !$opportunity->is_hot_deal]);
        return back()->with('success', 'Hot deal status toggled.');
    }
}
