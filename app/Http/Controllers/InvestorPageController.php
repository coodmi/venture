<?php

namespace App\Http\Controllers;

use App\Models\InvestorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class InvestorPageController extends Controller
{
    public function index(Request $request)
    {
        try {
            $hasVisible = Schema::hasColumn('investor_profiles', 'is_visible');

            $query = InvestorProfile::with('user');
            if ($hasVisible) $query->where('is_visible', true);

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
                try {
                    $q = InvestorProfile::where('investor_type', $t);
                    if ($hasVisible) $q->where('is_visible', true);
                    $counts[$t] = $q->count();
                } catch (\Exception $e) {
                    $counts[$t] = 0;
                }
            }
        } catch (\Exception $e) {
            $investors = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12);
            $types  = ['angel' => 'Angel Investor', 'vc' => 'Venture Capital', 'corporate' => 'Corporate Investor', 'family_office' => 'Family Office', 'impact' => 'Impact Investor'];
            $stages = ['pre_seed' => 'Pre-Seed', 'seed' => 'Seed', 'series_a' => 'Series A', 'series_b' => 'Series B', 'growth' => 'Growth'];
            $counts = array_fill_keys(array_keys($types), 0);
        }

        return view('investors.index', compact('investors', 'types', 'stages', 'counts'));
    }

    public function show(InvestorProfile $investor)
    {
        try {
            $hasVisible = Schema::hasColumn('investor_profiles', 'is_visible');
            if ($hasVisible) abort_if(!$investor->is_visible, 404);
            $investor->load('user');
        } catch (\Exception $e) {
            // continue
        }
        return view('investors.show', compact('investor'));
    }
}
