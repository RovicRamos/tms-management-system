<?php

namespace App\Services;

use App\Models\AdminNotification;
use App\Models\AdminLog;
use App\Models\User;

class AdminNotificationService
{
    /**
     * Create a notification for all admins
     */
    public static function notifyAllAdmins($title, $message, $type = 'system', $actionType = null, $relatedId = null)
    {
        $admins = User::where('role_id', 1)->get();
        
        foreach ($admins as $admin) {
            AdminNotification::create([
                'admin_id' => $admin->user_id,
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'action_type' => $actionType,
                'related_id' => $relatedId,
                'is_read' => false,
                'created_at' => now(),
            ]);
        }
    }

    /**
     * Create a notification for a specific admin
     */
    public static function notifyAdmin($adminId, $title, $message, $type = 'system', $actionType = null, $relatedId = null)
    {
        return AdminNotification::create([
            'admin_id' => $adminId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'action_type' => $actionType,
            'related_id' => $relatedId,
            'is_read' => false,
            'created_at' => now(),
        ]);
    }

    /**
     * Get unread notification count for admin
     */
    public static function getUnreadCount($adminId)
    {
        return AdminNotification::where('admin_id', $adminId)
            ->where('is_read', false)
            ->count();
    }

    /**
     * Get recent notifications
     */
    public static function getRecentNotifications($adminId, $limit = 10)
    {
        return AdminNotification::where('admin_id', $adminId)
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }
}
