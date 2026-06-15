<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Training & Seminar Portal</title>
    <link class="icon" type="image/png" href="/images/logo.png">
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
<body class="bg-gray-50 font-sans antialiased text-gray-900 min-h-screen flex flex-col justify-between">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                
                <div class="flex items-center gap-3">
                    <img src="/images/logo.png" 
                         alt="Global Seminar App Logo" 
                         class="h-9 w-auto object-contain">
                    <span class="text-2xl font-black tracking-wider text-deepOcean">TMS SYSTEM</span>
                </div>
                
                <div class="flex items-center space-x-6">
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-sm font-bold text-darkSlate">
                            {{ Auth::user() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : 'Client Attendee' }}
                        </span>
                        <span class="text-xs font-semibold tracking-wider uppercase text-softMutedTeal">
                            Portal Access
                        </span>
                    </div>

                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="text-xs font-bold text-crimson hover:text-white border border-crimson hover:bg-crimson px-3 py-1.5 rounded-lg transition duration-200">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-grow w-full space-y-10">
        
        <div class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-2 max-w-2xl">
                <span class="inline-flex items-center text-xs font-bold tracking-wider text-deepOcean uppercase bg-iceBlue px-2.5 py-1 rounded-md">
                    Attendee Dashboard
                </span>
                <h1 class="text-3xl font-extrabold text-darkSlate tracking-tight">
                    Available Training & Seminars
                </h1>
                <p class="text-slateGray text-sm sm:text-base leading-relaxed">
                    Select an event below to view schedule specifics, access your tracking modules, and reserve your registration seat.
                </p>
            </div>
            
            <div class="shrink-0">
                <div class="bg-gray-50 border border-gray-200 px-5 py-4 rounded-xl text-center">
                    <span class="block text-2xl font-black text-deepOcean">
                        {{ $events instanceof \Illuminate\Support\Collection ? $events->count() : (is_array($events) || $events instanceof \Countable ? count($events) : 0) }}
                    </span>
                    <span class="text-xs font-bold uppercase tracking-wider text-slateGray">Active Tracks</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($events as $event)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                    
                    <div class="p-6 space-y-5 flex-grow">
                        <div class="flex items-center justify-between">
                            <span class="inline-block text-xs font-bold text-white bg-softMutedTeal px-2.5 py-1 rounded-md uppercase tracking-wider">
                                {{ $event->capacity > 50 ? 'Technical Program' : 'Specialized Track' }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Open
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-darkSlate tracking-tight group-hover:text-deepOcean transition duration-200 line-clamp-2">
                            {{ $event->title }}
                        </h3>

                        <p class="text-sm text-slateGray leading-relaxed line-clamp-4">
                            {{ $event->description ?? 'No description available for this training program.' }}
                        </p>
                    </div>

                    <div class="bg-gray-50 px-6 py-5 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-auto">
                        <div class="text-xs font-medium text-slateGray tracking-wide">
                            Max Capacity: <span class="font-bold text-darkSlate bg-white border border-gray-200/80 px-2 py-1 rounded-md ml-1 shadow-2xs">{{ $event->capacity }} slots</span>
                        </div>
                        
                        <a href="/seminars/{{ $event->event_id }}" 
                           class="inline-flex items-center justify-center bg-deepOcean hover:bg-softOrange text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-sm hover:shadow transition duration-200 shrink-0">
                            View Available Sessions &rarr;
                        </a>
                    </div>

                </div>
            @empty
                <div class="sm:col-span-2 lg:col-span-3 text-center py-16 bg-white border border-gray-100 rounded-2xl shadow-sm max-w-xl mx-auto w-full space-y-4">
                    <div class="h-12 w-12 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center mx-auto text-xl font-bold">
                        !
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-lg font-bold text-darkSlate">No Active Seminars Found</h4>
                        <p class="text-sm text-slateGray max-w-sm mx-auto px-4">
                            Please check back again later as new development tracks and technical certifications are published.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-xs text-slateGray">
        &copy; 2026 Training Management System. All rights reserved.
    </footer>

</body>
</html>