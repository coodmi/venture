<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestorPageController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = DB::table('investor_profiles')
                ->join('users', 'investor_profiles.user_id', '=', 'users.id')
                ->select('investor_profiles.*', 'users.name as user_name', 'users.email as user_email');

            if ($request->filled('type'))   $query->where('investor_type', $request->type);
            if ($request->filled('stage'))  $query->where('investment_stage', $request->stage);
            if ($request->filled('search')) $query->where(function($q) use ($request) {
                $q->where('users.name', 'like', '%'.$request->search.'%')
                  ->orWhere('organization', 'like', '%'.$request->search.'%');
            });

            $investors = $query->latest('investor_profiles.created_at')->paginate(12);

            $types  = ['angel'=>'Angel Investor','vc'=>'Venture Capital','corporate'=>'Corporate','family_office'=>'Family Office','impact'=>'Impact Investor'];
            $stages = ['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];

            $counts = [];
            foreach (array_keys($types) as $t) {
                $counts[$t] = DB::table('investor_profiles')->where('investor_type', $t)->count();
            }
            $total = array_sum($counts);

        } catch (\Exception $e) {
            $investors = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12);
            $types  = ['angel'=>'Angel Investor','vc'=>'Venture Capital','corporate'=>'Corporate','family_office'=>'Family Office','impact'=>'Impact Investor'];
            $stages = ['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
            $counts = array_fill_keys(array_keys($types), 0);
            $total  = 0;
        }

        return view('investors.index', compact('investors', 'types', 'stages', 'counts', 'total'));
    }
}
