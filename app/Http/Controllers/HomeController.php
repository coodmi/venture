<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\Event;
use App\Models\News;
use App\Models\Testimonial;
use App\Models\PlatformStat;
use App\Models\NewsletterSubscription;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $stats        = PlatformStat::where('is_visible', true)->orderBy('sort_order')->get();
        $hotDeals     = Opportunity::approved()->hotDeals()->latest()->take(6)->get();
        $featured     = Opportunity::approved()->featured()->latest()->take(6)->get();
        $events       = Event::published()->upcoming()->orderBy('start_date')->take(4)->get();
        $testimonials = Testimonial::where('is_published', true)->orderBy('sort_order')->take(6)->get();
        $latestNews   = News::published()->ofType('news')->latest('published_at')->take(3)->get();
        $heroSlides   = json_decode(Setting::get('hero_slides', '[]'), true) ?: [];

        return view('home', compact('stats', 'hotDeals', 'featured', 'events', 'testimonials', 'latestNews', 'heroSlides'));
    }

    public function subscribe(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name'  => 'nullable|string|max:100',
        ]);

        NewsletterSubscription::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name, 'is_active' => true]
        );

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
