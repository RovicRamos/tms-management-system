<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSession;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = EventSession::with('event')->orderByDesc('session_id')->get();

        return view('admin.sessions.index', compact('sessions'));
    }

    public function create()
    {
        $events = Event::orderBy('title')->get();

        return view('admin.sessions.create', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => ['required', 'exists:events,event_id'],
            'session_title' => ['nullable', 'string', 'max:150'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        EventSession::create($validated);

        return redirect()->route('admin.sessions.index')->with('success', 'Session created successfully.');
    }

    public function edit(EventSession $session)
    {
        $events = Event::orderBy('title')->get();

        return view('admin.sessions.edit', compact('session', 'events'));
    }

    public function update(Request $request, EventSession $session)
    {
        $validated = $request->validate([
            'event_id' => ['required', 'exists:events,event_id'],
            'session_title' => ['nullable', 'string', 'max:150'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        $session->update($validated);

        return redirect()->route('admin.sessions.index')->with('success', 'Session updated successfully.');
    }

    public function destroy(EventSession $session)
    {
        $session->delete();

        return redirect()->route('admin.sessions.index')->with('success', 'Session deleted successfully.');
    }
}