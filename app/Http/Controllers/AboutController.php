<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;

class AboutController extends Controller
{
    public function index()
    {
        $sections = AboutContent::where('is_published', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section');

        return view('about', compact('sections'));
    }
}
