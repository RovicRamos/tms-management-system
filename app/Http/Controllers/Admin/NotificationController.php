<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        abort_unless($user && (int) $user->role_id === 1, 403);

        $notifications = AdminNotification::where('admin_id', $user->user_id)
            ->orderByDesc('created_at')
            ->paginate(20);

        $unreadCount = AdminNotification::where('admin_id', $user->user_id)
            ->where('is_read', false)
            ->count();

        return view('admin.notifications.index', compact('notifications', 'unreadCount'));
    }

    public function markAsRead($notificationId)
    {
        $user = Auth::user();
        $notification = AdminNotification::findOrFail($notificationId);

        abort_unless($notification->admin_id === $user->user_id, 403);

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        $user = Auth::user();

        AdminNotification::where('admin_id', $user->user_id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        return response()->json(['success' => true]);
    }

    public function delete($notificationId)
    {
        $user = Auth::user();
        $notification = AdminNotification::findOrFail($notificationId);

        abort_unless($notification->admin_id === $user->user_id, 403);

        $notification->delete();

        return response()->json(['success' => true]);
    }

    public function getUnreadCount()
    {
        $user = Auth::user();
        $count = AdminNotification::where('admin_id', $user->user_id)
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    public function getRecent()
    {
        $user = Auth::user();
        $notifications = AdminNotification::where('admin_id', $user->user_id)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return response()->json($notifications);
    }
}
