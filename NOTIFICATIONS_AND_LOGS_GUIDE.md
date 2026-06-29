# Admin Notification & Logging System

## Overview

The Training Management System includes comprehensive notification and activity logging features for admin users.

### Features

- **Real-time Notifications**: System alerts for important events
- **Activity Logging**: Complete audit trail of admin actions
- **Filtering & Export**: Filter logs and export to CSV
- **Mark as Read**: Track read/unread notification status

## Using the Notification System

### Notify All Admins

```php
use App\Services\AdminNotificationService;

AdminNotificationService::notifyAllAdmins(
    'Event Created',
    'A new training event has been created: PHP Advanced Training',
    'event',
    'event_created',
    $event->event_id
);
```

### Notify Specific Admin

```php
AdminNotificationService::notifyAdmin(
    $adminId,
    'New Enrollment',
    'New client registration for event: Web Development Basics',
    'enrollment',
    'new_enrollment',
    $enrollment->enrollment_id
);
```

### Get Unread Count

```php
$count = AdminNotificationService::getUnreadCount($adminId);
```

### Get Recent Notifications

```php
$notifications = AdminNotificationService::getRecentNotifications($adminId, 10);
```

## Using the Activity Logging System

### Log an Action

```php
use App\Models\AdminLog;

AdminLog::log(
    'created',           // action: 'created', 'updated', 'deleted', 'login', 'logout'
    'event',             // entity_type: 'event', 'user', 'enrollment', 'session'
    $event->event_id,    // entity_id (optional)
    'Created new event', // description (optional)
    ['field' => 'old_value', 'field' => 'new_value'] // changes (optional)
);
```

### Available Actions

- `created` - Entity was created
- `updated` - Entity was modified
- `deleted` - Entity was removed
- `login` - Admin logged in
- `logout` - Admin logged out

### Available Entity Types

- `event` - Training event
- `user` - User account
- `enrollment` - Client enrollment
- `session` - Event session

## Routes

### Notifications
- `GET /admin/notifications` - View all notifications
- `POST /admin/notifications/{id}/mark-read` - Mark single notification as read
- `POST /admin/notifications/mark-all-read` - Mark all as read
- `DELETE /admin/notifications/{id}` - Delete notification
- `GET /admin/notifications/unread/count` - Get unread count
- `GET /admin/notifications/recent` - Get recent notifications (JSON)

### Activity Logs
- `GET /admin/logs` - View all logs with stats
- `GET /admin/logs/{id}` - View specific log details
- `GET /admin/logs/filter` - Filter logs
- `GET /admin/logs/export` - Export logs to CSV

## Database Schema

### admin_notifications Table

| Column | Type | Description |
|--------|------|-------------|
| notification_id | ID | Primary key |
| admin_id | BigInt | Reference to user |
| title | String(255) | Notification title |
| message | Text | Notification content |
| type | String(50) | notification type (enrollment, event, user, system) |
| action_type | String(50) | Specific action type |
| related_id | BigInt | ID of related entity |
| is_read | Boolean | Read status |
| created_at | Timestamp | Creation time |
| read_at | Timestamp | Time when read |

### admin_logs Table

| Column | Type | Description |
|--------|------|-------------|
| log_id | ID | Primary key |
| admin_id | BigInt | Reference to admin user |
| action | String(100) | Action performed |
| entity_type | String(100) | Type of entity |
| entity_id | BigInt | ID of entity |
| description | Text | Action description |
| ip_address | String(45) | Admin's IP address |
| user_agent | String(255) | Browser info |
| changes | JSON | Detailed changes |
| created_at | Timestamp | When action occurred |

## Examples

### Example 1: Log Event Creation

In EventController.php store method:

```php
public function store(Request $request)
{
    $event = Event::create($request->validated());

    AdminLog::log(
        'created',
        'event',
        $event->event_id,
        'Created event: ' . $event->title
    );

    AdminNotificationService::notifyAllAdmins(
        'New Event Created',
        'Event: ' . $event->title,
        'event',
        'event_created',
        $event->event_id
    );

    return redirect()->route('admin.events.index');
}
```

### Example 2: Log User Update

In UserController.php update method:

```php
public function update(Request $request, User $user)
{
    $oldData = $user->getAttributes();
    $user->update($request->validated());
    
    AdminLog::log(
        'updated',
        'user',
        $user->user_id,
        'Updated user: ' . $user->email,
        [
            'before' => array_intersect_key($oldData, $request->validated()),
            'after' => $request->validated()
        ]
    );

    return redirect()->route('admin.users.index');
}
```

### Example 3: Access Notifications in View

```blade
@forelse ($recentNotifications as $notification)
    <div class="{{ !$notification->is_read ? 'bg-highlight' : '' }}">
        <h3>{{ $notification->title }}</h3>
        <p>{{ $notification->message }}</p>
        <small>{{ $notification->created_at->diffForHumans() }}</small>
    </div>
@empty
    <p>No notifications</p>
@endforelse
```

## Integration Tips

1. **Always log sensitive actions** - Add logging to all CRUD operations
2. **Notify on key events** - Use notifications for important business events
3. **Include context** - Add descriptive messages and related IDs
4. **Track changes** - Include before/after data for updates
5. **Export for audit** - Use CSV export for compliance reports

