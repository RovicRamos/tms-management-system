<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Manage Events</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darkSlate: '#082020', mutedTeal: '#5EAFBF', iceBlue: '#DDF2F7', softOrange: '#E57A44', terracotta: '#D1432A', deepOcean: '#0C4A60', crimson: '#D9534F', mustardGold: '#E6B800', slateGray: '#5B7582', softMutedTeal: '#4F9DA6',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900 min-h-screen">

<nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm"><div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"><div class="flex justify-between h-16 items-center"><div class="flex items-center gap-3"><img src="/images/logo.png" alt="TMS Logo" class="h-9 w-auto object-contain"><div><span class="block text-2xl font-black tracking-wider text-deepOcean">TMS SYSTEM</span><span class="block text-[11px] font-bold tracking-[0.24em] text-slateGray uppercase">Admin Console</span></div></div><div class="flex items-center gap-4"><a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-deepOcean hover:text-softMutedTeal">Back to Dashboard</a><a href="{{ route('admin.notifications.index') }}" class="relative text-deepOcean hover:text-softMutedTeal transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>@php $unread = \App\Models\AdminNotification::where('is_read', false)->count(); @endphp @if ($unread > 0)<span class="absolute -top-1.5 -right-1.5 bg-crimson text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">{{ $unread > 9 ? '9+' : $unread }}</span>@endif</a><form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="text-xs font-bold text-crimson hover:text-white border border-crimson hover:bg-crimson px-3 py-1.5 rounded-lg transition duration-200">Sign Out</button></form></div></div></div></nav>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
@if (session('success'))<div class="rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-3 text-sm">{{ session('success') }}</div>@endif

<section class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-sm">
    <div class="flex items-center justify-between gap-6">
        <div class="space-y-2">
            <span class="inline-flex items-center text-xs font-bold tracking-wider text-deepOcean uppercase bg-iceBlue px-3 py-1 rounded-full">Events</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-darkSlate tracking-tight">Manage Events</h1>
            <p class="text-slateGray text-sm sm:text-base">Create, update, and remove training events.</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="bg-softOrange text-white rounded-xl px-4 py-3 text-sm font-semibold hover:bg-orange-600 transition whitespace-nowrap">+ New Event</a>
    </div>
</section>

<section class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto"><table class="min-w-full text-sm"><thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-slateGray"><tr><th class="px-4 py-3">Title</th><th class="px-4 py-3">Type</th><th class="px-4 py-3">Instructor</th><th class="px-4 py-3">Capacity</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Actions</th></tr></thead><tbody class="divide-y divide-gray-100">@forelse($events as $event)<tr><td class="px-4 py-4 font-semibold text-darkSlate">{{ $event->title }}</td><td class="px-4 py-4">{{ $event->eventType?->type_name ?? 'N/A' }}</td><td class="px-4 py-4">{{ $event->instructor?->first_name }} {{ $event->instructor?->last_name }}</td><td class="px-4 py-4">{{ $event->capacity }}</td><td class="px-4 py-4">{{ $event->status }}</td><td class="px-4 py-4 space-x-3"><a class="font-semibold text-softMutedTeal" href="{{ route('admin.events.edit', $event) }}">Edit</a><form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="font-semibold text-crimson" onclick="return confirm('Delete this event?')">Delete</button></form></td></tr>@empty<tr><td class="px-4 py-8 text-slateGray" colspan="6">No events found.</td></tr>@endforelse</tbody></table></div>
</section>
</main>
</body>
</html>