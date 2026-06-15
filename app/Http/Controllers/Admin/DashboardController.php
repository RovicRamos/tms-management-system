<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Event;
use App\Models\EventSession;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        abort_unless($user && (int) $user->role_id === 1, 403);

        $stats = [
            'users' => User::count(),
            'admins' => User::where('role_id', 1)->count(),
            'clients' => User::where('role_id', 2)->count(),
            'events' => Event::count(),
            'sessions' => EventSession::count(),
            'enrollments' => Enrollment::count(),
        ];

        $recentUsers = User::select('user_id', 'first_name', 'last_name', 'email', 'role_id', 'created_at')
            ->orderByDesc('user_id')
            ->limit(5)
            ->get();

        $recentEvents = Event::select('event_id', 'title', 'capacity', 'status', 'created_at')
            ->orderByDesc('event_id')
            ->limit(5)
            ->get();

        $recentSessions = EventSession::with('event')
            ->select('session_id', 'event_id', 'session_title', 'start_date', 'location')
            ->orderByDesc('session_id')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentEvents', 'recentSessions'));
    }
}