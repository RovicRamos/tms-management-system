<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['eventType', 'instructor'])
            ->orderByDesc('event_id')
            ->get();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $eventTypes = EventType::orderBy('type_name')->get();
        $users = User::orderBy('first_name')->get();

        return view('admin.events.create', compact('eventTypes', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_id' => ['required', 'exists:event_types,type_id'],
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'instructor_id' => ['required', 'exists:users,user_id'],
            'capacity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $eventType = EventType::findOrFail($validated['type_id']);
        $instructor = User::findOrFail($validated['instructor_id']);

        if ((int) $instructor->role_id !== (int) $eventType->required_role_id) {
            return back()->withErrors([
                'instructor_id' => 'The selected instructor must match the role required by the event type.',
            ])->withInput();
        }

        Event::create([
            'type_id' => $eventType->type_id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'instructor_id' => $instructor->user_id,
            'instructor_role_id' => $eventType->required_role_id,
            'capacity' => $validated['capacity'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        $eventTypes = EventType::orderBy('type_name')->get();
        $users = User::orderBy('first_name')->get();

        return view('admin.events.edit', compact('event', 'eventTypes', 'users'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'type_id' => ['required', 'exists:event_types,type_id'],
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'instructor_id' => ['required', 'exists:users,user_id'],
            'capacity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $eventType = EventType::findOrFail($validated['type_id']);
        $instructor = User::findOrFail($validated['instructor_id']);

        if ((int) $instructor->role_id !== (int) $eventType->required_role_id) {
            return back()->withErrors([
                'instructor_id' => 'The selected instructor must match the role required by the event type.',
            ])->withInput();
        }

        $event->update([
            'type_id' => $eventType->type_id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'instructor_id' => $instructor->user_id,
            'instructor_role_id' => $eventType->required_role_id,
            'capacity' => $validated['capacity'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}