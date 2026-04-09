<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\PlatformStat;
use App\Models\Testimonial;
use App\Models\AboutContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function general()
    {
        return view('admin.settings.general');
    }

    public function updateGeneral(Request $request)
    {
        $settings = ['site_name', 'site_tagline', 'site_email', 'site_phone', 'site_address', 'facebook_url', 'twitter_url', 'linkedin_url'];

        foreach ($settings as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key), 'general');
            }
        }

        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $path, 'general');
        }

        return back()->with('success', 'Settings saved.');
    }

    public function stats()
    {
        $stats = PlatformStat::orderBy('sort_order')->get();
        return view('admin.settings.stats', compact('stats'));
    }

    public function updateStats(Request $request)
    {
        foreach ($request->input('stats', []) as $id => $data) {
            PlatformStat::where('id', $id)->update(['value' => $data['value'], 'label' => $data['label']]);
        }
        return back()->with('success', 'Stats updated.');
    }

    public function testimonials()
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();
        return view('admin.settings.testimonials', compact('testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'content' => 'required|string',
            'photo'   => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['photo', '_token']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        Testimonial::create($data);
        return back()->with('success', 'Testimonial added.');
    }

    public function about()
    {
        $sections = AboutContent::orderBy('sort_order')->get()->keyBy('section');
        return view('admin.settings.about', compact('sections'));
    }

    public function updateAbout(Request $request)
    {
        foreach ($request->input('sections', []) as $section => $data) {
            AboutContent::updateOrCreate(
                ['section' => $section],
                ['title' => $data['title'] ?? null, 'content' => $data['content'] ?? null, 'is_published' => true]
            );
        }
        return back()->with('success', 'About content updated.');
    }
}
