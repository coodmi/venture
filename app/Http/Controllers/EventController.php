<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::published();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('type')) {
            $query->where('event_type', $request->type);
        }

        $upcoming = (clone $query)->upcoming()->withCount('registrations')->orderBy('start_date')->paginate(9);
        $past     = Event::published()->where('start_date', '<', now())->withCount('registrations')->latest('start_date')->take(6)->get();

        return view('events.index', compact('upcoming', 'past'));
    }

    public function show(Event $event)
    {
        abort_if($event->status !== 'published', 404);
        $moreEvents = Event::published()
            ->upcoming()
            ->where('id', '!=', $event->id)
            ->orderBy('start_date')
            ->take(3)
            ->get();
        return view('events.show', compact('event', 'moreEvents'));
    }

    public function demo(string $slug)
    {
        // Serve a fake Event object for demo cards when no DB events exist
        $demos = [
            'venturematch-investor-summit-2026' => [
                'title'             => 'VentureMatch Investor Summit 2026',
                'summary'           => 'Annual flagship summit bringing together 300+ investors, founders, and ecosystem leaders for a full day of keynotes, panels, and deal-making.',
                'event_type'        => 'offline',
                'category'          => 'Summit',
                'venue'             => 'Radisson Blu, Dhaka, Bangladesh',
                'start_date'        => '2026-05-15 09:00:00',
                'end_date'          => '2026-05-15 18:00:00',
                'registration_open' => true,
                'is_featured'       => true,
                'max_attendees'     => 300,
            ],
            'startup-showcase-fintech-edition' => [
                'title'             => 'Startup Showcase: FinTech Edition',
                'summary'           => '10 curated FinTech startups pitch live to a panel of investors. Open to all registered investors on the platform.',
                'event_type'        => 'online',
                'category'          => 'Showcase',
                'venue'             => 'Online (Zoom)',
                'start_date'        => '2026-05-28 14:00:00',
                'end_date'          => '2026-05-28 17:00:00',
                'registration_open' => true,
                'is_featured'       => false,
                'max_attendees'     => 200,
            ],
            'investor-networking-night' => [
                'title'             => 'Investor Networking Night',
                'summary'           => 'An exclusive evening of cocktails and conversations for VentureMatch members. Build relationships that turn into partnerships.',
                'event_type'        => 'offline',
                'category'          => 'Networking',
                'venue'             => 'The Westin, Dhaka',
                'start_date'        => '2026-06-05 18:30:00',
                'end_date'          => '2026-06-05 21:30:00',
                'registration_open' => true,
                'is_featured'       => false,
                'max_attendees'     => 80,
            ],
            'due-diligence-masterclass' => [
                'title'             => 'Due Diligence Masterclass',
                'summary'           => 'A hands-on workshop for investors covering financial modeling, term sheets, and startup valuation frameworks.',
                'event_type'        => 'online',
                'category'          => 'Workshop',
                'venue'             => 'Online (Zoom)',
                'start_date'        => '2026-06-12 10:00:00',
                'end_date'          => '2026-06-12 13:00:00',
                'registration_open' => true,
                'is_featured'       => false,
                'max_attendees'     => 150,
            ],
            'agritech-cleantech-deal-day' => [
                'title'             => 'AgriTech & CleanTech Deal Day',
                'summary'           => 'Sector-focused deal day featuring 8 vetted AgriTech and CleanTech startups seeking Series A and growth-stage capital.',
                'event_type'        => 'hybrid',
                'category'          => 'Showcase',
                'venue'             => 'Pan Pacific Sonargaon, Dhaka',
                'start_date'        => '2026-06-20 11:00:00',
                'end_date'          => '2026-06-20 17:00:00',
                'registration_open' => false,
                'is_featured'       => false,
                'max_attendees'     => 120,
            ],
            'founder-bootcamp-pitch-perfect' => [
                'title'             => 'Founder Bootcamp: Pitch Perfect',
                'summary'           => 'A 2-day intensive bootcamp for founders to refine their pitch, financial model, and investor narrative before going live on the platform.',
                'event_type'        => 'offline',
                'category'          => 'Bootcamp',
                'venue'             => 'VentureMatch HQ, Dhaka',
                'start_date'        => '2026-07-03 09:00:00',
                'end_date'          => '2026-07-04 17:00:00',
                'registration_open' => true,
                'is_featured'       => false,
                'max_attendees'     => 40,
            ],
        ];

        abort_if(!isset($demos[$slug]), 404);
        $data = $demos[$slug];

        $event = new Event();
        $event->title             = $data['title'];
        $event->summary           = $data['summary'];
        $event->event_type        = $data['event_type'];
        $event->category          = $data['category'];
        $event->venue             = $data['venue'];
        $event->start_date        = \Carbon\Carbon::parse($data['start_date']);
        $event->end_date          = \Carbon\Carbon::parse($data['end_date']);
        $event->registration_open = $data['registration_open'];
        $event->is_featured       = $data['is_featured'];
        $event->max_attendees     = $data['max_attendees'];
        $event->banner            = null;
        $event->description       = null;
        $event->speakers          = null;
        $event->agenda            = null;
        $event->slug              = $slug;

        return view('events.demo', compact('event'));
    }

    public function register(Request $request, Event $event)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'phone'        => 'nullable|string|max:20',
            'organization' => 'nullable|string|max:255',
            'designation'  => 'nullable|string|max:255',
        ]);

        EventRegistration::create([
            'event_id'     => $event->id,
            'user_id'      => Auth::id(),
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'organization' => $request->organization,
            'designation'  => $request->designation,
            'status'       => 'pending',
        ]);

        return back()->with('success', 'Registration submitted. You will receive a confirmation shortly.');
    }
}
