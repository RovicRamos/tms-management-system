<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        abort_unless($user && (int) $user->role_id === 1, 403);

        $logs = AdminLog::with('admin')
            ->orderByDesc('created_at')
            ->paginate(50);

        $actionStats = AdminLog::selectRaw('action, COUNT(*) as count')
            ->groupBy('action')
            ->get();

        $entityStats = AdminLog::selectRaw('entity_type, COUNT(*) as count')
            ->groupBy('entity_type')
            ->get();

        return view('admin.logs.index', compact('logs', 'actionStats', 'entityStats'));
    }

    public function show($logId)
    {
        $user = Auth::user();
        abort_unless($user && (int) $user->role_id === 1, 403);

        $log = AdminLog::with('admin')->findOrFail($logId);

        return view('admin.logs.show', compact('log'));
    }

    public function filter()
    {
        $user = Auth::user();
        abort_unless($user && (int) $user->role_id === 1, 403);

        $action = request('action');
        $entityType = request('entity_type');
        $adminId = request('admin_id');
        $dateFrom = request('date_from');
        $dateTo = request('date_to');

        $query = AdminLog::with('admin');

        if ($action) {
            $query->where('action', $action);
        }

        if ($entityType) {
            $query->where('entity_type', $entityType);
        }

        if ($adminId) {
            $query->where('admin_id', $adminId);
        }

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $logs = $query->orderByDesc('created_at')->paginate(50);

        return view('admin.logs.index', compact('logs'));
    }

    public function export()
    {
        $user = Auth::user();
        abort_unless($user && (int) $user->role_id === 1, 403);

        $logs = AdminLog::with('admin')
            ->orderByDesc('created_at')
            ->get();

        $csv = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="admin-logs.csv"');

        fputcsv($csv, ['Log ID', 'Admin', 'Action', 'Entity Type', 'Entity ID', 'Description', 'IP Address', 'Timestamp']);

        foreach ($logs as $log) {
            fputcsv($csv, [
                $log->log_id,
                $log->admin?->first_name . ' ' . $log->admin?->last_name,
                $log->action,
                $log->entity_type,
                $log->entity_id,
                $log->description,
                $log->ip_address,
                $log->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        fclose($csv);
        exit;
    }
}
