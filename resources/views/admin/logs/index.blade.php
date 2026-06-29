<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Admin Activity Logs</title>
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
                    <span class="inline-flex items-center text-xs font-bold tracking-wider text-deepOcean uppercase bg-iceBlue px-3 py-1 rounded-full">Activity Logs</span>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-darkSlate tracking-tight">Admin Activity Tracking</h1>
                    <p class="text-slateGray text-sm sm:text-base">Monitor all admin actions and system events.</p>
                </div>
                <a href="{{ route('admin.logs.export') }}" class="bg-deepOcean text-white rounded-xl px-4 py-3 text-sm font-semibold hover:bg-softMutedTeal transition">Export CSV</a>
            </div>
        </section>

        <!-- Filter Form -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="text-lg font-bold text-darkSlate mb-4">Filter Logs</h3>
            <form method="GET" action="{{ route('admin.logs.filter') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-darkSlate mb-2">Action</label>
                    <select name="action" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-deepOcean">
                        <option value="">All Actions</option>
                        <option value="created">Created</option>
                        <option value="updated">Updated</option>
                        <option value="deleted">Deleted</option>
                        <option value="login">Login</option>
                        <option value="logout">Logout</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-darkSlate mb-2">Entity Type</label>
                    <select name="entity_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-deepOcean">
                        <option value="">All Types</option>
                        <option value="event">Event</option>
                        <option value="user">User</option>
                        <option value="enrollment">Enrollment</option>
                        <option value="session">Session</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-darkSlate mb-2">Date From</label>
                    <input type="date" name="date_from" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-deepOcean">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-darkSlate mb-2">Date To</label>
                    <input type="date" name="date_to" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-deepOcean">
                </div>
                <button type="submit" class="md:col-span-2 lg:col-span-4 bg-deepOcean text-white rounded-lg px-4 py-2 font-semibold hover:bg-softMutedTeal transition">Filter</button>
            </form>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-lg font-bold text-darkSlate mb-4">Actions Distribution</h3>
                <div class="space-y-2">
                    @forelse ($actionStats as $stat)
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slateGray">{{ ucfirst($stat->action) }}</span>
                            <span class="font-bold text-darkSlate">{{ $stat->count }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-slateGray">No data</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-lg font-bold text-darkSlate mb-4">Entity Types</h3>
                <div class="space-y-2">
                    @forelse ($entityStats as $stat)
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slateGray">{{ ucfirst($stat->entity_type) }}</span>
                            <span class="font-bold text-darkSlate">{{ $stat->count }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-slateGray">No data</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Logs Table -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold tracking-widest uppercase text-slateGray">Admin</th>
                            <th class="px-6 py-4 text-left text-xs font-bold tracking-widest uppercase text-slateGray">Action</th>
                            <th class="px-6 py-4 text-left text-xs font-bold tracking-widest uppercase text-slateGray">Entity</th>
                            <th class="px-6 py-4 text-left text-xs font-bold tracking-widest uppercase text-slateGray">Description</th>
                            <th class="px-6 py-4 text-left text-xs font-bold tracking-widest uppercase text-slateGray">IP Address</th>
                            <th class="px-6 py-4 text-left text-xs font-bold tracking-widest uppercase text-slateGray">Timestamp</th>
                            <th class="px-6 py-4 text-left text-xs font-bold tracking-widest uppercase text-slateGray">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($logs as $log)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-darkSlate">
                                    {{ $log->admin ? $log->admin->first_name . ' ' . $log->admin->last_name : 'System' }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                        {{ $log->action === 'created' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $log->action === 'updated' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $log->action === 'deleted' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $log->action === 'login' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ !in_array($log->action, ['created', 'updated', 'deleted', 'login']) ? 'bg-gray-100 text-gray-800' : '' }}
                                    ">
                                        {{ ucfirst($log->action) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slateGray">{{ ucfirst($log->entity_type) }}</td>
                                <td class="px-6 py-4 text-sm text-slateGray">{{ $log->description ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-slateGray">{{ $log->ip_address ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-slateGray">{{ $log->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('admin.logs.show', $log->log_id) }}" class="text-deepOcean hover:text-softMutedTeal font-semibold">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-slateGray">No logs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $logs->links() }}
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-xs text-slateGray mt-8">&copy; 2026 Training Management System. All rights reserved.</footer>

</body>
</html>
