<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use App\Models\InvestorInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpportunityController extends Controller
{
    public function index(Request $request)
    {
        $query = Opportunity::approved()->with('seekerProfile');

        if ($request->filled('sector')) {
            $query->where('sector', $request->sector);
        }
        if ($request->filled('stage')) {
            $query->where('stage', $request->stage);
        }
        if ($request->filled('location')) {
            $query->where('country', $request->location);
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $opportunities = $query->latest()->paginate(12);

        return view('investor.opportunities.index', compact('opportunities'));
    }

    public function show(Opportunity $opportunity)
    {
        abort_if($opportunity->status !== 'approved', 404);
        $opportunity->increment('views');
        return view('investor.opportunities.show', compact('opportunity'));
    }

    public function action(Request $request, Opportunity $opportunity)
    {
        $request->validate(['action' => 'required|in:saved,interested,meeting_requested,shortlisted']);

        $profile = Auth::user()->investorProfile;
        abort_if(!$profile, 403, 'Complete your investor profile first.');

        InvestorInterest::updateOrCreate(
            ['investor_profile_id' => $profile->id, 'opportunity_id' => $opportunity->id, 'action' => $request->action],
            ['notes' => $request->notes]
        );

        return back()->with('success', 'Action recorded successfully.');
    }
}
