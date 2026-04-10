<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;

class StartupController extends Controller
{
    public function index(Request $request)
    {
        $query = Opportunity::approved()->with('seekerProfile');

        if ($request->filled('sector'))  $query->where('sector', $request->sector);
        if ($request->filled('stage'))   $query->where('stage', $request->stage);
        if ($request->filled('search'))  $query->where('title', 'like', '%'.$request->search.'%');

        $opportunities = $query->latest()->paginate(12);

        $sectors = Opportunity::approved()->distinct()->pluck('sector')->filter()->sort()->values();
        $stages  = Opportunity::approved()->distinct()->pluck('stage')->filter()->sort()->values();

        return view('startups.index', compact('opportunities', 'sectors', 'stages'));
    }

    public function show(Opportunity $opportunity)
    {
        abort_if($opportunity->status !== 'approved', 404);
        $opportunity->increment('views');
        $related = Opportunity::approved()->where('sector', $opportunity->sector)
            ->where('id', '!=', $opportunity->id)->take(3)->get();
        return view('startups.show', compact('opportunity', 'related'));
    }
}
