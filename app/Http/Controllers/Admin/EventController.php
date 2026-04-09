<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('registrations')->latest()->paginate(20);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'start_date' => 'required|date',
            'event_type' => 'required|in:online,offline,hybrid',
            'banner'     => 'nullable|image|max:4096',
        ]);

        $data = $request->except(['banner', '_token']);
        $data['speakers'] = $request->input('speakers', []);

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('events/banners', 'public');
        }

        Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Event created.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->except(['banner', '_token', '_method']);

        if ($request->hasFile('banner')) {
            if ($event->banner) Storage::disk('public')->delete($event->banner);
            $data['banner'] = $request->file('banner')->store('events/banners', 'public');
        }

        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted.');
    }

    public function registrations(Event $event)
    {
        $registrations = $event->registrations()->latest()->paginate(20);
        return view('admin.events.registrations', compact('event', 'registrations'));
    }
}
