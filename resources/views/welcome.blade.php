<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Training Management System</title>
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
<body class="bg-white font-sans antialiased text-gray-900">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <img src="/images/logo.png" alt="Global Seminar App Logo" class="h-9 w-auto object-contain">
                    <span class="text-2xl font-black tracking-wider text-deepOcean">TMS SYSTEM</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8 font-medium text-gray-600">
                    <a href="#features" class="hover:text-softMutedTeal transition">Features</a>
                    <a href="#events" class="hover:text-softMutedTeal transition">Browse Events</a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.login') }}" class="text-sm font-semibold text-deepOcean hover:text-softMutedTeal transition">Admin Login</a>
                    <a href="/login" class="text-sm font-semibold text-gray-700 hover:text-deepOcean transition">Log In</a>
                    <a href="/register" class="text-sm font-semibold bg-softOrange text-white px-4 py-2 rounded-lg shadow-sm hover:bg-terracotta transition">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="relative bg-white overflow-hidden border-b border-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32 grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <span class="inline-flex items-center text-xs font-semibold tracking-wider text-deepOcean uppercase bg-iceBlue px-3 py-1 rounded-full">
                    Elevate Your Professional Skills
                </span>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-darkSlate tracking-tight leading-tight">
                    Centralized Hub for <span class="text-softMutedTeal">Seminars & Technical Training</span>
                </h1>
                <p class="text-lg text-slateGray leading-relaxed">
                    Welcome to the Training Management System. Schedule modules, reserve seats, manage attendees, and track certifications all from a single dashboard interface.
                </p>
                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="#events" class="bg-softOrange text-white font-medium px-6 py-3 rounded-xl shadow-md hover:bg-terracotta transition">
                        Explore Open Modules
                    </a>
                    <a href="#features" class="bg-iceBlue text-deepOcean font-medium px-6 py-3 rounded-xl hover:bg-opacity-70 transition">
                        Learn More
                    </a>
                </div>
            </div>
            
            <div class="hidden md:block bg-gray-50 rounded-2xl p-8 border border-gray-100 shadow-sm">
                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 space-y-4">
                    <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                        <h3 class="font-bold text-darkSlate">System Status Console</h3>
                        <span class="h-2.5 w-2.5 rounded-full bg-softMutedTeal animate-pulse"></span>
                    </div>
                    
                    <div class="h-6 w-full rounded-md overflow-hidden flex shadow-inner my-2">
                        <div class="bg-darkSlate w-1/5"></div>
                        <div class="bg-mutedTeal w-1/5"></div>
                        <div class="bg-iceBlue w-1/5"></div>
                        <div class="bg-softOrange w-1/5"></div>
                        <div class="bg-terracotta w-1/5"></div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-center pt-2">
                        <div class="bg-white p-3 rounded-lg border border-gray-200">
                            <span class="block text-xl font-bold text-deepOcean">Database</span>
                            <span class="text-xs text-slateGray uppercase font-bold tracking-wider">Synced (SQLite)</span>
                        </div>
                        <div class="bg-white p-3 rounded-lg border border-gray-200">
                            <span class="block text-xl font-bold text-softMutedTeal">Models</span>
                            <span class="text-xs text-slateGray uppercase font-bold tracking-wider">Eloquent Setup</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main id="events" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-8">
        <div>
            <h2 class="text-3xl font-bold text-darkSlate tracking-tight">Upcoming Training Modules</h2>
            <p class="text-slateGray mt-1">Discover upcoming skill-building workshops and technical seminars.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition flex flex-col justify-between">
                <div class="p-6 space-y-4">
                    <span class="inline-block text-xs font-bold text-white bg-crimson px-2.5 py-1 rounded-md uppercase tracking-wider">Seminar</span>
                    <h3 class="text-xl font-bold text-darkSlate line-clamp-1">Advanced Laravel Architecture</h3>
                    <p class="text-sm text-slateGray line-clamp-3 leading-relaxed">Master enterprise relational design patterns, custom schemas, and deep Eloquent query constraints.</p>
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-xs font-semibold text-slateGray">Capacity: 30 Seats</span>
                    <button class="text-sm font-bold text-deepOcean hover:text-softMutedTeal transition">View Details &rarr;</button>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition flex flex-col justify-between">
                <div class="p-6 space-y-4">
                    <span class="inline-block text-xs font-bold text-darkSlate bg-mustardGold px-2.5 py-1 rounded-md uppercase tracking-wider">Workshop</span>
                    <h3 class="text-xl font-bold text-darkSlate line-clamp-1">Relational Database Normalization</h3>
                    <p class="text-sm text-slateGray line-clamp-3 leading-relaxed">Understanding key design patterns, structural integrity check constraints, and composite unique indices.</p>
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-xs font-semibold text-slateGray">Capacity: 100 Seats</span>
                    <button class="text-sm font-bold text-softMutedTeal hover:text-deepOcean transition">View Details &rarr;</button>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition flex flex-col justify-between">
                <div class="p-6 space-y-4">
                    <span class="inline-block text-xs font-bold text-white bg-softMutedTeal px-2.5 py-1 rounded-md uppercase tracking-wider">Technical Training</span>
                    <h3 class="text-xl font-bold text-darkSlate line-clamp-1">API Authentication Protocols</h3>
                    <p class="text-sm text-slateGray line-clamp-3 leading-relaxed">Implementing secure tokens, managing session drivers, and protecting sensitive administrative routes safely.</p>
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-xs font-semibold text-slateGray">Capacity: 45 Seats</span>
                    <button class="text-sm font-bold text-deepOcean hover:text-softMutedTeal transition">View Details &rarr;</button>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center text-sm text-slateGray">
            &copy; 2026 Training Management System (TMS SYSTEM). All rights reserved.
        </div>
    </footer>

</body>
</html>