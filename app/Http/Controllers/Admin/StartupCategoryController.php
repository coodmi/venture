<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

/**
 * Admin Startup Category Controller
 * Manages the list of startup sectors/categories stored in Settings.
 */
class StartupCategoryController extends Controller
{
    public function index()
    {
        $sectors = array_map('trim', explode(',', Setting::get('startups_sectors', 'FinTech,AgriTech,HealthTech,EdTech,CleanTech,E-Commerce,Real Estate,Manufacturing,Logistics,Media')));
        return view('admin.startup-categories.index', compact('sectors'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);
        $sectors = array_map('trim', explode(',', Setting::get('startups_sectors', '')));
        $sectors = array_filter($sectors);
        if (!in_array(trim($request->name), $sectors)) {
            $sectors[] = trim($request->name);
        }
        Setting::set('startups_sectors', implode(',', $sectors), 'startups');
        return back()->with('success', 'Category added.');
    }

    public function destroy(Request $request, string $name)
    {
        $sectors = array_map('trim', explode(',', Setting::get('startups_sectors', '')));
        $sectors = array_filter($sectors, fn($s) => $s !== urldecode($name));
        Setting::set('startups_sectors', implode(',', $sectors), 'startups');
        return back()->with('success', 'Category removed.');
    }
}
