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

        if ($request->hasFile('site_favicon')) {
            $path = $request->file('site_favicon')->store('settings', 'public');
            Setting::set('site_favicon', $path, 'general');
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

    public function header()
    {
        $menuItems = json_decode(Setting::get('nav_menu_items', '[]'), true) ?: [];
        return view('admin.settings.header', compact('menuItems'));
    }

    public function updateHeader(Request $request)
    {
        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $path, 'general');
        }

        $items = [];
        foreach ($request->input('menu_label', []) as $i => $label) {
            if (trim($label)) {
                $items[] = ['label' => $label, 'url' => $request->input('menu_url')[$i] ?? '/'];
            }
        }
        Setting::set('nav_menu_items', json_encode($items), 'general');

        return back()->with('success', 'Header settings saved.');
    }

    public function heroSlider()
    {
        $slides = json_decode(Setting::get('hero_slides', '[]'), true) ?: [];
        return view('admin.settings.hero', compact('slides'));
    }

    public function updateHeroSlider(Request $request)
    {
        $slides = [];
        foreach ($request->input('slides', []) as $i => $slide) {
            $item = [
                'type'     => $slide['type'] ?? 'image',
                'title'    => $slide['title'] ?? '',
                'subtitle' => $slide['subtitle'] ?? '',
                'btn1_text'=> $slide['btn1_text'] ?? '',
                'btn1_url' => $slide['btn1_url'] ?? '',
                'btn2_text'=> $slide['btn2_text'] ?? '',
                'btn2_url' => $slide['btn2_url'] ?? '',
                'video_url'=> $slide['video_url'] ?? '',
                'image'    => $slide['existing_image'] ?? '',
            ];
            if (isset($request->file('slides')[$i]['image'])) {
                $path = $request->file('slides')[$i]['image']->store('hero', 'public');
                $item['image'] = $path;
            }
            $slides[] = $item;
        }
        Setting::set('hero_slides', json_encode($slides), 'general');
        return back()->with('success', 'Hero slider saved.');
    }

    public function startupsPage()
    {
        return view('admin.settings.startups');
    }

    public function updateStartupsPage(Request $request)
    {
        $keys = ['startups_hero_badge','startups_hero_title','startups_hero_subtitle','startups_cta_title','startups_cta_subtitle','startups_sectors'];
        foreach ($keys as $key) {
            if ($request->has($key)) Setting::set($key, $request->input($key), 'startups');
        }
        return back()->with('success', 'Startups page settings saved.');
    }

    public function about()
    {
        $sections = AboutContent::all()->keyBy('section');
        return view('admin.settings.about', compact('sections'));
    }

    public function updateAbout(Request $request)
    {
        foreach ($request->input('sections', []) as $section => $data) {
            $updateData = [
                'title'        => $data['title'] ?? null,
                'content'      => $data['content'] ?? null,
                'extra'        => isset($data['extra']) ? $data['extra'] : null,
                'is_published' => true,
            ];
            // Handle founder photo upload
            if ($section === 'founder_message' && $request->hasFile('founder_photo')) {
                $updateData['image'] = $request->file('founder_photo')->store('about', 'public');
            }
            AboutContent::updateOrCreate(['section' => $section], $updateData);
        }

        // Handle board members (JSON array)
        if ($request->has('board_members')) {
            $members = [];
            foreach ($request->input('board_members.name', []) as $i => $name) {
                if (trim($name)) {
                    $photo = $request->input('board_members.photo')[$i] ?? '';
                    // Handle new photo upload
                    if ($request->hasFile("board_member_photos.$i")) {
                        $photo = $request->file("board_member_photos.$i")->store('board_members', 'public');
                    }
                    $members[] = [
                        'name'  => $name,
                        'role'  => $request->input('board_members.role')[$i] ?? '',
                        'org'   => $request->input('board_members.org')[$i] ?? '',
                        'bio'   => $request->input('board_members.bio')[$i] ?? '',
                        'photo' => $photo,
                    ];
                }
            }
            AboutContent::updateOrCreate(
                ['section' => 'board_members'],
                ['title' => 'Board Members', 'extra' => $members, 'is_published' => true]
            );
        }

        // Handle highlights (stats boxes)
        if ($request->has('highlights')) {
            $highlights = [];
            foreach ($request->input('highlights.value', []) as $i => $val) {
                if (trim($val)) {
                    $highlights[] = [
                        'value' => $val,
                        'label' => $request->input('highlights.label')[$i] ?? '',
                    ];
                }
            }
            AboutContent::updateOrCreate(
                ['section' => 'highlights'],
                ['title' => 'Highlights', 'extra' => $highlights, 'is_published' => true]
            );
        }

        return back()->with('success', 'About content updated.');
    }
}
