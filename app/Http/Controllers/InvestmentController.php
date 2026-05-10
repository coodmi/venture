<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Opportunity::approved()->with('user');

        if ($request->filled('sector'))  $query->where('sector', $request->sector);
        if ($request->filled('stage'))   $query->where('stage', $request->stage);
        if ($request->filled('search'))  $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%'.$request->search.'%')
              ->orWhere('business_problem', 'like', '%'.$request->search.'%');
        });
        if ($request->type === 'hot')      $query->where('is_hot_deal', true);
        if ($request->type === 'featured') $query->where('is_featured', true);

        $opportunities = $query->latest()->paginate(12);
        $sectors = Opportunity::approved()->distinct()->pluck('sector')->filter()->sort()->values();
        $stages  = Opportunity::approved()->distinct()->pluck('stage')->filter()->sort()->values();

        $stats = [
            'total'    => Opportunity::approved()->count(),
            'hot'      => Opportunity::approved()->where('is_hot_deal', true)->count(),
            'featured' => Opportunity::approved()->where('is_featured', true)->count(),
            'sectors'  => Opportunity::approved()->distinct('sector')->count('sector'),
        ];

        return view('investment.index', compact('opportunities', 'sectors', 'stages', 'stats'));
    }

    public function show(Opportunity $opportunity)
    {
        abort_if($opportunity->status !== 'approved', 404);
        $opportunity->increment('views');
        $related = Opportunity::approved()
            ->where('sector', $opportunity->sector)
            ->where('id', '!=', $opportunity->id)
            ->latest()->take(3)->get();
        return view('investment.show', compact('opportunity', 'related'));
    }
}
