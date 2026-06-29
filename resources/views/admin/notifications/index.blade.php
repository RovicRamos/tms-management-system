<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Admin Notifications</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darkSlate: '#082020',
                        mutedTeal: '#5EAFBF',
                        iceBlue: '#DDF2F7',
                        softOrange: '#E57A44',
                        terracotta: '#D1432A',
                        deepOcean: '#0C4A60',
                        crimson: '#D9534F',
                        mustardGold: '#E6B800',
                        slateGray: '#5B7582',
                        softMutedTeal: '#4F9DA6',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900 min-h-screen">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <img src="/images/logo.png" alt="TMS Logo" class="h-9 w-auto object-contain">
                    <div>
                        <span class="block text-2xl font-black tracking-wider text-deepOcean">TMS SYSTEM</span>
                        <span class="block text-[11px] font-bold tracking-[0.24em] text-slateGray uppercase">Admin Console</span>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-deepOcean hover:text-softMutedTeal">Back to Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-xs font-bold text-crimson hover:text-white border border-crimson hover:bg-crimson px-3 py-1.5 rounded-lg transition duration-200">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
        <section class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-sm">
            <div class="flex items-center justify-between gap-6">
                <div class="space-y-2">
                    <span class="inline-flex items-center text-xs font-bold tracking-wider text-deepOcean uppercase bg-iceBlue px-3 py-1 rounded-full">Notifications</span>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-darkSlate tracking-tight">Message Center</h1>
                    <p class="text-slateGray text-sm sm:text-base">View all system notifications and alerts.</p>
                </div>
                <button onclick="markAllRead()" class="bg-deepOcean text-white rounded-xl px-4 py-3 text-sm font-semibold hover:bg-softMutedTeal transition">Mark All as Read</button>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="space-y-4">
                        <div class="bg-iceBlue rounded-xl p-4">
                            <p class="text-xs font-bold text-deepOcean uppercase tracking-wider">Unread</p>
                            <p class="text-3xl font-black text-darkSlate mt-2">{{ $unreadCount }}</p>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="block w-full bg-gray-100 hover:bg-gray-200 text-darkSlate rounded-xl px-4 py-2 text-sm font-semibold text-center transition">Dashboard</a>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="divide-y divide-gray-100">
                        @forelse ($notifications as $notification)
                            <div class="px-6 py-4 hover:bg-gray-50 transition {{ !$notification->is_read ? 'bg-iceBlue' : '' }}">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <h3 class="font-semibold text-darkSlate">{{ $notification->title }}</h3>
                                            @if (!$notification->is_read)
                                                <span class="inline-block w-2 h-2 bg-softOrange rounded-full"></span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-slateGray mt-1">{{ $notification->message }}</p>
                                        <div class="mt-2 flex items-center gap-2">
                                            <span class="inline-flex items-center rounded-full bg-gray-200 px-2 py-1 text-xs font-semibold text-darkSlate">
                                                {{ $notification->type }}
                                            </span>
                                            <span class="text-xs text-slateGray">{{ $notification->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        @if (!$notification->is_read)
                                            <button onclick="markAsRead({{ $notification->notification_id }})" class="text-xs bg-deepOcean text-white px-3 py-1 rounded-lg hover:bg-softMutedTeal transition">Mark Read</button>
                                        @endif
                                        <button onclick="deleteNotification({{ $notification->notification_id }})" class="text-xs bg-crimson text-white px-3 py-1 rounded-lg hover:bg-terracotta transition">Delete</button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-8 text-center text-slateGray">
                                <p>No notifications yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-xs text-slateGray mt-8">&copy; 2026 Training Management System. All rights reserved.</footer>

    <script>
        function markAsRead(notificationId) {
            fetch(`/admin/notifications/${notificationId}/mark-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Content-Type': 'application/json',
                }
            }).then(() => location.reload());
        }

        function markAllRead() {
            fetch('/admin/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Content-Type': 'application/json',
                }
            }).then(() => location.reload());
        }

        function deleteNotification(notificationId) {
            if (confirm('Delete this notification?')) {
                fetch(`/admin/notifications/${notificationId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Content-Type': 'application/json',
                    }
                }).then(() => location.reload());
            }
        }
    </script>

</body>
</html>
