<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Admin Dashboard</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
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
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-sm font-bold text-darkSlate">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                        <span class="text-xs font-semibold tracking-wider uppercase text-softMutedTeal">Administrator</span>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-xs font-bold text-crimson hover:text-white border border-crimson hover:bg-crimson px-3 py-1.5 rounded-lg transition duration-200">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
        <section class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-sm flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
            <div class="space-y-4 max-w-3xl">
                <span class="inline-flex items-center text-xs font-bold tracking-wider text-deepOcean uppercase bg-iceBlue px-3 py-1 rounded-full">Admin Dashboard</span>
                <div class="space-y-2">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-darkSlate tracking-tight">Operations at a glance</h1>
                    <p class="text-slateGray text-sm sm:text-base leading-relaxed">Track users, monitor training activity, and keep the seminar system organized from a single control center.</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:gap-4 min-w-full lg:min-w-[320px]">
                <a href="{{ route('seminars') }}" class="bg-deepOcean text-white rounded-xl px-4 py-3 text-sm font-semibold text-center hover:bg-softMutedTeal transition">Open Client Portal</a>
                <a href="{{ route('register') }}" class="bg-softOrange text-white rounded-xl px-4 py-3 text-sm font-semibold text-center hover:bg-terracotta transition">New Client Signup</a>
            </div>
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5"><p class="text-xs font-bold tracking-widest uppercase text-slateGray">Total Users</p><div class="mt-3 flex items-end justify-between"><span class="text-4xl font-black text-darkSlate">{{ $stats['users'] }}</span><span class="text-sm font-semibold text-softMutedTeal">All accounts</span></div></div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5"><p class="text-xs font-bold tracking-widest uppercase text-slateGray">Administrators</p><div class="mt-3 flex items-end justify-between"><span class="text-4xl font-black text-darkSlate">{{ $stats['admins'] }}</span><span class="text-sm font-semibold text-softMutedTeal">Role 1</span></div></div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5"><p class="text-xs font-bold tracking-widest uppercase text-slateGray">Clients</p><div class="mt-3 flex items-end justify-between"><span class="text-4xl font-black text-darkSlate">{{ $stats['clients'] }}</span><span class="text-sm font-semibold text-softMutedTeal">Role 2</span></div></div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5"><p class="text-xs font-bold tracking-widest uppercase text-slateGray">Events</p><div class="mt-3 flex items-end justify-between"><span class="text-4xl font-black text-darkSlate">{{ $stats['events'] }}</span><span class="text-sm font-semibold text-softMutedTeal">Training tracks</span></div></div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5"><p class="text-xs font-bold tracking-widest uppercase text-slateGray">Sessions</p><div class="mt-3 flex items-end justify-between"><span class="text-4xl font-black text-darkSlate">{{ $stats['sessions'] }}</span><span class="text-sm font-semibold text-softMutedTeal">Live schedules</span></div></div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5"><p class="text-xs font-bold tracking-widest uppercase text-slateGray">Enrollments</p><div class="mt-3 flex items-end justify-between"><span class="text-4xl font-black text-darkSlate">{{ $stats['enrollments'] }}</span><span class="text-sm font-semibold text-softMutedTeal">Registrations</span></div></div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-6">
                <div class="space-y-2 mb-6">
                    <h2 class="text-lg font-bold text-darkSlate">Enrollment Trends (30 Days)</h2>
                    <p class="text-sm text-slateGray">Daily enrollments in the training management system.</p>
                </div>
                <div style="position: relative; height: 300px;">
                    <canvas id="enrollmentTrendsChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-6">
                <div class="space-y-2 mb-6">
                    <h2 class="text-lg font-bold text-darkSlate">User Registrations (12 Months)</h2>
                    <p class="text-sm text-slateGray">Monthly new client account registrations.</p>
                </div>
                <div style="position: relative; height: 300px;">
                    <canvas id="userRegistrationChart"></canvas>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-6">
                <div class="space-y-2 mb-6">
                    <h2 class="text-lg font-bold text-darkSlate">Events by Status</h2>
                    <p class="text-sm text-slateGray">Distribution of training events across different statuses.</p>
                </div>
                <div style="position: relative; height: 300px;">
                    <canvas id="eventsByStatusChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-6">
                <div class="space-y-2 mb-6">
                    <h2 class="text-lg font-bold text-darkSlate">Enrollments by Event Type</h2>
                    <p class="text-sm text-slateGray">Total registrations grouped by training category.</p>
                </div>
                <div style="position: relative; height: 300px;">
                    <canvas id="enrollmentsByTypeChart"></canvas>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between"><div><h2 class="text-lg font-bold text-darkSlate">Recent Events</h2><p class="text-sm text-slateGray">Latest training items added to the system.</p></div><span class="text-xs font-bold tracking-wider uppercase text-softMutedTeal">Overview</span></div>
                <div class="divide-y divide-gray-100">
                    @forelse ($recentEvents as $event)
                        <div class="px-6 py-4 flex items-start justify-between gap-4"><div class="space-y-1"><p class="font-semibold text-darkSlate">{{ $event->title }}</p><p class="text-sm text-slateGray">Capacity {{ $event->capacity }} seats</p></div><span class="inline-flex shrink-0 items-center rounded-full bg-iceBlue px-3 py-1 text-xs font-bold text-deepOcean">{{ $event->status }}</span></div>
                    @empty
                        <div class="px-6 py-8 text-sm text-slateGray">No events found yet.</div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between"><div><h2 class="text-lg font-bold text-darkSlate">Recent Users</h2><p class="text-sm text-slateGray">Newest accounts registered in the platform.</p></div><span class="text-xs font-bold tracking-wider uppercase text-softMutedTeal">Accounts</span></div>
                <div class="divide-y divide-gray-100">
                    @forelse ($recentUsers as $account)
                        <div class="px-6 py-4 flex items-start justify-between gap-4"><div class="space-y-1"><p class="font-semibold text-darkSlate">{{ $account->first_name }} {{ $account->last_name }}</p><p class="text-sm text-slateGray">{{ $account->email }}</p></div><span class="inline-flex shrink-0 items-center rounded-full bg-iceBlue px-3 py-1 text-xs font-bold text-deepOcean">Role {{ $account->role_id }}</span></div>
                    @empty
                        <div class="px-6 py-8 text-sm text-slateGray">No users found yet.</div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100"><h2 class="text-lg font-bold text-darkSlate">Recent Sessions</h2><p class="text-sm text-slateGray">Upcoming or recently created seminar sessions.</p></div>
                <div class="divide-y divide-gray-100">
                    @forelse ($recentSessions as $session)
                        <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2"><div><p class="font-semibold text-darkSlate">{{ $session->session_title ?? $session->event?->title ?? 'Session' }}</p><p class="text-sm text-slateGray">{{ $session->location }}</p></div><span class="text-xs font-bold uppercase tracking-wider text-softMutedTeal">{{ $session->start_date ? \Illuminate\Support\Carbon::parse($session->start_date)->format('M d, Y') : 'No date set' }}</span></div>
                    @empty
                        <div class="px-6 py-8 text-sm text-slateGray">No sessions found yet.</div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between"><div><h2 class="text-lg font-bold text-darkSlate">Recent Notifications</h2><p class="text-sm text-slateGray">Latest system alerts and updates.</p></div><a href="{{ route('admin.notifications.index') }}" class="text-xs font-bold tracking-wider uppercase text-softMutedTeal hover:text-deepOcean">View All</a></div>
                <div class="divide-y divide-gray-100">
                    @forelse ($recentNotifications as $notification)
                        <div class="px-6 py-4 flex items-start justify-between gap-4 {{ !$notification->is_read ? 'bg-iceBlue' : '' }}"><div class="space-y-1 flex-1"><p class="font-semibold text-darkSlate">{{ $notification->title }}</p><p class="text-sm text-slateGray">{{ $notification->message }}</p><span class="text-xs text-slateGray">{{ $notification->created_at->diffForHumans() }}</span></div><span class="inline-flex shrink-0 items-center rounded-full bg-gray-200 px-3 py-1 text-xs font-bold text-darkSlate">{{ $notification->type }}</span></div>
                    @empty
                        <div class="px-6 py-8 text-sm text-slateGray">No notifications yet.</div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div><h2 class="text-lg font-bold text-darkSlate">Management Tools</h2><p class="text-sm text-slateGray">Direct access to the main management screens.</p></div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                <a href="{{ route('admin.events.index') }}" class="rounded-2xl border border-gray-200 bg-gray-50 p-4 hover:border-softMutedTeal hover:shadow-sm transition"><p class="font-semibold text-darkSlate">Manage Events</p><p class="text-sm text-slateGray mt-1">Create and maintain training events.</p></a>
                <a href="{{ route('admin.sessions.index') }}" class="rounded-2xl border border-gray-200 bg-gray-50 p-4 hover:border-softMutedTeal hover:shadow-sm transition"><p class="font-semibold text-darkSlate">Manage Sessions</p><p class="text-sm text-slateGray mt-1">Schedule event sessions and locations.</p></a>
                <a href="{{ route('admin.users.index') }}" class="rounded-2xl border border-gray-200 bg-gray-50 p-4 hover:border-softMutedTeal hover:shadow-sm transition"><p class="font-semibold text-darkSlate">Manage Users</p><p class="text-sm text-slateGray mt-1">Edit roles and account status.</p></a>
                <a href="{{ route('admin.enrollments.index') }}" class="rounded-2xl border border-gray-200 bg-gray-50 p-4 hover:border-softMutedTeal hover:shadow-sm transition"><p class="font-semibold text-darkSlate">Manage Enrollments</p><p class="text-sm text-slateGray mt-1">Review client registrations.</p></a>
                <a href="{{ route('admin.notifications.index') }}" class="rounded-2xl border border-gray-200 bg-gray-50 p-4 hover:border-softMutedTeal hover:shadow-sm transition"><p class="font-semibold text-darkSlate">View Notifications</p><p class="text-sm text-slateGray mt-1">System notifications and alerts.</p></a>
                <a href="{{ route('admin.logs.index') }}" class="rounded-2xl border border-gray-200 bg-gray-50 p-4 hover:border-softMutedTeal hover:shadow-sm transition"><p class="font-semibold text-darkSlate">View Activity Logs</p><p class="text-sm text-slateGray mt-1">Monitor admin actions and events.</p></a>
            </div>
        </section>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-xs text-slateGray mt-8">&copy; 2026 Training Management System. All rights reserved.</footer>

    <script>
        // Color palette
        const colors = {
            primary: '#0C4A60',
            secondary: '#5EAFBF',
            success: '#4F9DA6',
            warning: '#E6B800',
            danger: '#D9534F',
            light: '#DDF2F7',
            dark: '#082020',
        };

        // Enrollment Trends Chart
        const enrollmentCtx = document.getElementById('enrollmentTrendsChart').getContext('2d');
        new Chart(enrollmentCtx, {
            type: 'line',
            data: {
                labels: @json($enrollmentTrends['labels']),
                datasets: [{
                    label: 'Daily Enrollments',
                    data: @json($enrollmentTrends['data']),
                    borderColor: colors.primary,
                    backgroundColor: 'rgba(12, 74, 96, 0.05)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: colors.primary,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                        },
                        ticks: {
                            color: '#5B7582',
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            color: '#5B7582',
                        }
                    }
                }
            }
        });

        // User Registration Chart
        const userRegCtx = document.getElementById('userRegistrationChart').getContext('2d');
        new Chart(userRegCtx, {
            type: 'bar',
            data: {
                labels: @json($userRegistrationTrends['labels']),
                datasets: [{
                    label: 'New Clients',
                    data: @json($userRegistrationTrends['data']),
                    backgroundColor: colors.secondary,
                    borderColor: colors.primary,
                    borderWidth: 1,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                        },
                        ticks: {
                            color: '#5B7582',
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            color: '#5B7582',
                        }
                    }
                }
            }
        });

        // Events by Status Chart
        const statusCtx = document.getElementById('eventsByStatusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: @json($eventsByStatus['labels']),
                datasets: [{
                    data: @json($eventsByStatus['data']),
                    backgroundColor: @json($eventsByStatus['backgroundColor']),
                    borderColor: '#fff',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            color: '#5B7582',
                            font: {
                                size: 12,
                                weight: '500',
                            }
                        }
                    }
                }
            }
        });

        // Enrollments by Event Type Chart
        const typeCtx = document.getElementById('enrollmentsByTypeChart').getContext('2d');
        new Chart(typeCtx, {
            type: 'bar',
            data: {
                labels: @json($enrollmentsByEventType['labels']),
                datasets: [{
                    label: 'Total Enrollments',
                    data: @json($enrollmentsByEventType['data']),
                    backgroundColor: [colors.primary, colors.secondary, colors.success, colors.warning, colors.danger],
                    borderRadius: 6,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                        },
                        ticks: {
                            color: '#5B7582',
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            color: '#5B7582',
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>