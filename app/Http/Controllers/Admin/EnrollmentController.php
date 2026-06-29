<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\AdminLog;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['event', 'client'])->orderByDesc('enrollment_id')->get();

        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function destroy(Enrollment $enrollment)
    {
        AdminLog::log(
            'deleted',
            'enrollment',
            $enrollment->enrollment_id,
            'Deleted enrollment for client ID ' . $enrollment->client_id . ' from event ID ' . $enrollment->event_id
        );

        $enrollment->delete();

        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
}