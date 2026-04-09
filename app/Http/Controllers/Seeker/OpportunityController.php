<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OpportunityController extends Controller
{
    public function index()
    {
        $opportunities = Auth::user()->opportunities()->latest()->paginate(10);
        return view('seeker.opportunities.index', compact('opportunities'));
    }

    public function create()
    {
        return view('seeker.opportunities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'sector'          => 'required|string',
            'stage'           => 'required|string',
            'business_problem'=> 'required|string',
            'solution'        => 'required|string',
            'target_market'   => 'required|string',
            'ask_amount'      => 'required|numeric|min:1',
            'use_of_funds'    => 'required|string',
            'pitch_deck'      => 'nullable|file|mimes:pdf,ppt,pptx|max:20480',
        ]);

        $data = $request->except(['pitch_deck', '_token']);
        $data['user_id']          = Auth::id();
        $data['seeker_profile_id'] = Auth::user()->seekerProfile?->id;
        $data['status']           = $request->input('action') === 'submit' ? 'submitted' : 'draft';

        if ($request->hasFile('pitch_deck')) {
            $data['pitch_deck'] = $request->file('pitch_deck')->store('opportunities/decks', 'public');
        }

        Opportunity::create($data);

        return redirect()->route('seeker.opportunities.index')
            ->with('success', 'Opportunity ' . ($data['status'] === 'submitted' ? 'submitted' : 'saved as draft') . ' successfully.');
    }

    public function edit(Opportunity $opportunity)
    {
        abort_if($opportunity->user_id !== Auth::id(), 403);
        return view('seeker.opportunities.edit', compact('opportunity'));
    }

    public function update(Request $request, Opportunity $opportunity)
    {
        abort_if($opportunity->user_id !== Auth::id(), 403);

        $data = $request->except(['pitch_deck', '_token', '_method']);
        $data['status'] = $request->input('action') === 'submit' ? 'submitted' : 'draft';

        if ($request->hasFile('pitch_deck')) {
            if ($opportunity->pitch_deck) Storage::disk('public')->delete($opportunity->pitch_deck);
            $data['pitch_deck'] = $request->file('pitch_deck')->store('opportunities/decks', 'public');
        }

        $opportunity->update($data);

        return redirect()->route('seeker.opportunities.index')
            ->with('success', 'Opportunity updated successfully.');
    }

    public function show(Opportunity $opportunity)
    {
        abort_if($opportunity->user_id !== Auth::id(), 403);
        $interests = $opportunity->interests()->with('investorProfile.user')->latest()->get();
        return view('seeker.opportunities.show', compact('opportunity', 'interests'));
    }
    public function destroy(Opportunity $opportunity)
    {
        abort_if($opportunity->user_id !== Auth::id(), 403);
        abort_if(!in_array($opportunity->status, ['draft', 'revision_required']), 403, 'Cannot delete a submitted opportunity.');

        if ($opportunity->pitch_deck) {
            Storage::disk('public')->delete($opportunity->pitch_deck);
        }

        $opportunity->delete();

        return redirect()->route('seeker.opportunities.index')
            ->with('success', 'Opportunity deleted.');
    }
}
