<?php

namespace App\Http\Controllers;

use App\Models\InvestorProfile;
use Illuminate\Http\Request;

class InvestorPageController extends Controller
{
    public function index(Request $request)
    {
        $query = InvestorProfile::with('user')->where('is_visible', true);

        if ($request->filled('type'))   $query->where('investor_type', $request->type);
        if ($request->filled('stage'))  $query->where('investment_stage', $request->stage);
        if ($request->filled('search')) $query->where(function($q) use ($request) {
            $q->where('organization', 'like', '%'.$request->search.'%')
              ->orWhereHas('user', fn($u) => $u->where('name', 'like', '%'.$request->search.'%'));
        });

        $investors = $query->latest()->paginate(12);

        $types  = ['angel' => 'Angel Investor', 'vc' => 'Venture Capital', 'corporate' => 'Corporate Investor', 'family_office' => 'Family Office', 'impact' => 'Impact Investor'];
        $stages = ['pre_seed' => 'Pre-Seed', 'seed' => 'Seed', 'series_a' => 'Series A', 'series_b' => 'Series B', 'growth' => 'Growth'];

        $counts = [];
        foreach (array_keys($types) as $t) {
            $counts[$t] = InvestorProfile::where('is_visible', true)->where('investor_type', $t)->count();
        }

        return view('investors.index', compact('investors', 'types', 'stages', 'counts'));
    }

    public function show(InvestorProfile $investor)
    {
        abort_if(!$investor->is_visible, 404);
        $investor->load('user');
        return view('investors.show', compact('investor'));
    }
}
