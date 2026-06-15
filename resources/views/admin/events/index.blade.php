<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Manage Events</title>
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
<nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm"><div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"><div class="flex justify-between h-16 items-center"><div class="flex items-center gap-3"><a href="{{ route('admin.dashboard') }}" class="text-deepOcean font-black tracking-wider text-2xl">TMS SYSTEM</a><span class="hidden sm:inline text-xs font-bold tracking-[0.24em] text-slateGray uppercase">Admin Console</span></div><div class="flex items-center gap-3"><a href="{{ route('admin.events.create') }}" class="bg-softOrange text-white px-4 py-2 rounded-lg text-sm font-semibold">New Event</a><a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-deepOcean hover:text-softMutedTeal">Dashboard</a></div></div></div></nav>
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
@if (session('success'))<div class="rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-3 text-sm">{{ session('success') }}</div>@endif
<section class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm"><h1 class="text-3xl font-extrabold text-darkSlate">Manage Events</h1><p class="text-slateGray mt-1">Create, update, and remove training events.</p></section>
<section class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto"><table class="min-w-full text-sm"><thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-slateGray"><tr><th class="px-4 py-3">Title</th><th class="px-4 py-3">Type</th><th class="px-4 py-3">Instructor</th><th class="px-4 py-3">Capacity</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Actions</th></tr></thead><tbody class="divide-y divide-gray-100">@forelse($events as $event)<tr><td class="px-4 py-4 font-semibold text-darkSlate">{{ $event->title }}</td><td class="px-4 py-4">{{ $event->eventType?->type_name ?? 'N/A' }}</td><td class="px-4 py-4">{{ $event->instructor?->first_name }} {{ $event->instructor?->last_name }}</td><td class="px-4 py-4">{{ $event->capacity }}</td><td class="px-4 py-4">{{ $event->status }}</td><td class="px-4 py-4 space-x-3"><a class="font-semibold text-softMutedTeal" href="{{ route('admin.events.edit', $event) }}">Edit</a><form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="font-semibold text-crimson" onclick="return confirm('Delete this event?')">Delete</button></form></td></tr>@empty<tr><td class="px-4 py-8 text-slateGray" colspan="6">No events found.</td></tr>@endforelse</tbody></table></div>
</section>
</main>
</body>
</html>