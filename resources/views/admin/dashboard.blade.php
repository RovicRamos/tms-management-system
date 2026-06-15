<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Admin Dashboard</title>
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

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                <div><h2 class="text-lg font-bold text-darkSlate">Quick Actions</h2><p class="text-sm text-slateGray">Direct access to the main management screens.</p></div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <a href="{{ route('admin.events.index') }}" class="rounded-2xl border border-gray-200 bg-gray-50 p-4 hover:border-softMutedTeal hover:shadow-sm transition"><p class="font-semibold text-darkSlate">Manage events</p><p class="text-sm text-slateGray mt-1">Create and maintain training events.</p></a>
                    <a href="{{ route('admin.sessions.index') }}" class="rounded-2xl border border-gray-200 bg-gray-50 p-4 hover:border-softMutedTeal hover:shadow-sm transition"><p class="font-semibold text-darkSlate">Manage sessions</p><p class="text-sm text-slateGray mt-1">Schedule event sessions and locations.</p></a>
                    <a href="{{ route('admin.users.index') }}" class="rounded-2xl border border-gray-200 bg-gray-50 p-4 hover:border-softMutedTeal hover:shadow-sm transition"><p class="font-semibold text-darkSlate">Manage users</p><p class="text-sm text-slateGray mt-1">Edit roles and account status.</p></a>
                    <a href="{{ route('admin.enrollments.index') }}" class="rounded-2xl border border-gray-200 bg-gray-50 p-4 hover:border-softMutedTeal hover:shadow-sm transition"><p class="font-semibold text-darkSlate">Manage enrollments</p><p class="text-sm text-slateGray mt-1">Review client registrations.</p></a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-xs text-slateGray mt-8">&copy; 2026 Training Management System. All rights reserved.</footer>

</body>
</html>