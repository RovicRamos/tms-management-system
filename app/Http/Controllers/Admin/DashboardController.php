<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Event;
use App\Models\EventSession;
use App\Models\EventType;
use App\Models\User;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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

        // Chart Data: Enrollment Trends (Last 30 days)
        $enrollmentTrends = $this->getEnrollmentTrends();

        // Chart Data: Events by Status
        $eventsByStatus = $this->getEventsByStatus();

        // Chart Data: Enrollments by Event Type
        $enrollmentsByEventType = $this->getEnrollmentsByEventType();

        // Chart Data: User Registrations (Last 30 days)
        $userRegistrationTrends = $this->getUserRegistrationTrends();

        // Recent Notifications
        $recentNotifications = AdminNotification::where('admin_id', $user->user_id)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentUsers',
            'recentEvents',
            'recentSessions',
            'enrollmentTrends',
            'eventsByStatus',
            'enrollmentsByEventType',
            'userRegistrationTrends',
            'recentNotifications'
        ));
    }

    private function getEnrollmentTrends()
    {
        $last30Days = collect(range(29, 0))->map(function ($daysAgo) {
            return Carbon::now()->subDays($daysAgo)->toDateString();
        });

        $enrollments = Enrollment::selectRaw("strftime('%Y-%m-%d', registration_date) as date, COUNT(*) as count")
            ->whereBetween('registration_date', [
                Carbon::now()->subDays(29)->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->groupByRaw("strftime('%Y-%m-%d', registration_date)")
            ->get()
            ->keyBy('date');

        $data = $last30Days->map(function ($date) use ($enrollments) {
            return $enrollments->get($date)?->count ?? 0;
        })->toArray();

        $labels = $last30Days->map(function ($date) {
            return Carbon::parse($date)->format('M d');
        })->toArray();

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    private function getEventsByStatus()
    {
        $statusCounts = Event::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->toArray();

        $statuses = array_column($statusCounts, 'status');
        $counts = array_column($statusCounts, 'count');

        $colors = [
            'active' => '#0C4A60',
            'completed' => '#5EAFBF',
            'cancelled' => '#D9534F',
            'pending' => '#E6B800',
        ];

        return [
            'labels' => $statuses,
            'data' => $counts,
            'backgroundColor' => array_map(function ($status) use ($colors) {
                return $colors[$status] ?? '#5B7582';
            }, $statuses),
        ];
    }

    private function getEnrollmentsByEventType()
    {
        $eventTypeEnrollments = EventType::selectRaw('event_types.type_name, COUNT(enrollments.enrollment_id) as count')
            ->leftJoin('events', 'event_types.type_id', '=', 'events.type_id')
            ->leftJoin('enrollments', 'events.event_id', '=', 'enrollments.event_id')
            ->groupBy('event_types.type_id', 'event_types.type_name')
            ->get()
            ->toArray();

        $typeNames = array_column($eventTypeEnrollments, 'type_name');
        $counts = array_column($eventTypeEnrollments, 'count');

        return [
            'labels' => $typeNames,
            'data' => $counts,
        ];
    }

    private function getUserRegistrationTrends()
    {
        $last12Months = collect(range(11, 0))->map(function ($monthsAgo) {
            return Carbon::now()->subMonths($monthsAgo);
        });

        $users = User::selectRaw("strftime('%Y-%m-01', created_at) as month, COUNT(*) as count")
            ->where('role_id', 2)
            ->whereBetween('created_at', [
                Carbon::now()->subMonths(11)->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
            ->groupByRaw("strftime('%Y-%m-01', created_at)")
            ->get()
            ->keyBy('month');

        $data = $last12Months->map(function ($month) use ($users) {
            $monthKey = $month->format('Y-m-01');
            return $users->get($monthKey)?->count ?? 0;
        })->toArray();

        $labels = $last12Months->map(function ($month) {
            return $month->format('M Y');
        })->toArray();

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
}