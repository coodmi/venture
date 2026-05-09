<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Admin Startup Controller
 * Manages startup/opportunity listings from the admin panel.
 * Startups are stored as Opportunity records (same model, admin view).
 */
class StartupController extends Controller
{
    public function index(Request $request)
    {
        $query = Opportunity::with('user');

        if ($request->filled('status'))  $query->where('status', $request->status);
        if ($request->filled('sector'))  $query->where('sector', $request->sector);
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $startups = $query->latest()->paginate(20);
        return view('admin.opportunities.index', ['opportunities' => $startups]);
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

    public function show(Opportunity $startup)
    {
        $startup->load(['user', 'seekerProfile', 'interests.investorProfile.user']);
        return view('admin.opportunities.show', ['opportunity' => $startup]);
    }

    public function edit(Opportunity $startup)
    {
        return view('admin.opportunities.edit', ['opportunity' => $startup]);
    }

    public function update(Request $request, Opportunity $startup)
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

        $data = $request->except(['pitch_deck', '_token', '_method']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_hot_deal']  = $request->boolean('is_hot_deal');

        if ($request->hasFile('pitch_deck')) {
            if ($startup->pitch_deck) {
                Storage::disk('public')->delete($startup->pitch_deck);
            }
            $data['pitch_deck'] = $request->file('pitch_deck')->store('opportunities/decks', 'public');
        }

        $startup->update($data);

        return redirect()->route('admin.opportunities.index')
            ->with('success', 'Startup updated successfully.');
    }

    public function destroy(Opportunity $startup)
    {
        if ($startup->pitch_deck) {
            Storage::disk('public')->delete($startup->pitch_deck);
        }
        $startup->delete();

        return redirect()->route('admin.opportunities.index')
            ->with('success', 'Startup deleted.');
    }

    public function toggleFeatured(Opportunity $startup)
    {
        $startup->update(['is_featured' => !$startup->is_featured]);
        return back()->with('success', 'Featured status toggled.');
    }

    public function toggleHotDeal(Opportunity $startup)
    {
        $startup->update(['is_hot_deal' => !$startup->is_hot_deal]);
        return back()->with('success', 'Hot deal status toggled.');
    }

    public function bulkPublish(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            Opportunity::whereIn('id', $ids)->update(['status' => 'approved']);
        }
        return back()->with('success', 'Selected startups published.');
    }

    public function bulkUnpublish(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            Opportunity::whereIn('id', $ids)->update(['status' => 'archived']);
        }
        return back()->with('success', 'Selected startups unpublished.');
    }

    public function deleteLogo(Opportunity $startup)
    {
        // Logo is stored as pitch_deck for now; extend if a separate logo field is added
        return back()->with('info', 'No logo field configured.');
    }

    public function deleteCoverImage(Opportunity $startup)
    {
        return back()->with('info', 'No cover image field configured.');
    }
}
