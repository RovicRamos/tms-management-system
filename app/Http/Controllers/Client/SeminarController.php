<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event; // <-- Add this model reference at the top

class SeminarController extends Controller
{
    /**
     * Display a listing of upcoming seminars for clients.
     */
    public function index()
    {
        // Use your Event Model. This guarantees safe countable collections for your blade file!
        $events = Event::select('event_id', 'title', 'description', 'capacity', 'status')->get();

        // Points exactly to resources/views/client/seminars.blade.php
        return view('client.seminars', compact('events'));
    }
}