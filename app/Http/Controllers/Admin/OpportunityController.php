<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OpportunityController extends Controller
{
    public function index(Request $request)
    {
        $query = Opportunity::with(['user', 'seekerProfile']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('sector')) {
            $query->where('sector', $request->sector);
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $opportunities = $query->latest()->paginate(20);
        return view('admin.opportunities.index', compact('opportunities'));
    }

    public function create()
    {
        return view('admin.opportunities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'sector'           => 'nullable|string',
            'stage'            => 'nullable|string',
            'location'         => 'nullable|string|max:255',
            'country'          => 'nullable|string|max:100',
            'business_problem' => 'nullable|string',
            'solution'         => 'nullable|string',
            'target_market'    => 'nullable|string',
            'traction'         => 'nullable|string',
            'ask_amount'       => 'nullable|numeric|min:0',
            'ask_currency'     => 'nullable|string|max:10',
            'use_of_funds'     => 'nullable|string',
            'key_metrics'      => 'nullable|string',
            'status'           => 'required|in:draft,submitted,under_review,approved,rejected,archived',
            'pitch_deck'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $data = $request->except(['pitch_deck', '_token']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_hot_deal']  = $request->boolean('is_hot_deal');

        if ($request->hasFile('pitch_deck')) {
            $data['pitch_deck'] = $request->file('pitch_deck')->store('opportunities/decks', 'public');
        }

        Opportunity::create($data);

        return redirect()->route('admin.opportunities.index')
            ->with('success', 'Startup created successfully.');
    }

    public function show(Opportunity $opportunity)
    {
        $opportunity->load(['user', 'seekerProfile', 'interests.investorProfile.user']);
        return view('admin.opportunities.show', compact('opportunity'));
    }

    public function edit(Opportunity $opportunity)
    {
        $opportunity->load(['seekerProfile', 'user.seekerProfile']);
        return view('admin.opportunities.edit', compact('opportunity'));
    }

    public function update(Request $request, Opportunity $opportunity)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'sector'           => 'nullable|string',
            'stage'            => 'nullable|string',
            'location'         => 'nullable|string|max:255',
            'country'          => 'nullable|string|max:100',
            'business_problem' => 'nullable|string',
            'solution'         => 'nullable|string',
            'target_market'    => 'nullable|string',
            'traction'         => 'nullable|string',
            'ask_amount'       => 'nullable|numeric|min:0',
            'ask_currency'     => 'nullable|string|max:10',
            'use_of_funds'     => 'nullable|string',
            'key_metrics'      => 'nullable|string',
            'status'           => 'required|in:draft,submitted,under_review,approved,rejected,archived',
            'pitch_deck'       => 'nullable|file|mimes:pdf|max:10240',
            'company_logo'     => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['pitch_deck', 'company_logo', '_token', '_method']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_hot_deal']  = $request->boolean('is_hot_deal');

        if ($request->hasFile('pitch_deck')) {
            if ($opportunity->pitch_deck) {
                Storage::disk('public')->delete($opportunity->pitch_deck);
            }
            $data['pitch_deck'] = $request->file('pitch_deck')->store('opportunities/decks', 'public');
        }

        $opportunity->update($data);

        // Update company logo on the seeker profile if uploaded
        if ($request->hasFile('company_logo')) {
            // Find seeker profile via the opportunity's user or direct relationship
            $seekerProfile = $opportunity->seekerProfile
                ?? $opportunity->user?->seekerProfile;

            if ($seekerProfile) {
                if ($seekerProfile->company_logo) {
                    Storage::disk('public')->delete($seekerProfile->company_logo);
                }
                $seekerProfile->update([
                    'company_logo' => $request->file('company_logo')->store('seekers/logos', 'public'),
                ]);
            }
        }

        return redirect()->route('admin.opportunities.index')
            ->with('success', 'Startup updated successfully.');
    }

    public function destroy(Opportunity $opportunity)
    {
        if ($opportunity->pitch_deck) {
            Storage::disk('public')->delete($opportunity->pitch_deck);
        }
        $opportunity->delete();

        return redirect()->route('admin.opportunities.index')
            ->with('success', 'Startup deleted.');
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
