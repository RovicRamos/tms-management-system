<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Log Details</title>
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
                    <a href="{{ route('admin.logs.index') }}" class="text-sm font-semibold text-deepOcean hover:text-softMutedTeal">Back to Logs</a>
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
            <div class="space-y-2">
                <span class="inline-flex items-center text-xs font-bold tracking-wider text-deepOcean uppercase bg-iceBlue px-3 py-1 rounded-full">Log Details</span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-darkSlate tracking-tight">Activity Entry #{{ $log->log_id }}</h1>
                <p class="text-slateGray text-sm sm:text-base">Detailed information about this system action.</p>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-6">
                    <div>
                        <h2 class="text-lg font-bold text-darkSlate mb-4">Basic Information</h2>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-1">
                                    <label class="text-xs font-bold tracking-widest uppercase text-slateGray">Log ID</label>
                                    <p class="text-lg font-semibold text-darkSlate">{{ $log->log_id }}</p>
                                </div>
                                <div class="col-span-1">
                                    <label class="text-xs font-bold tracking-widest uppercase text-slateGray">Action</label>
                                    <p class="text-lg font-semibold text-darkSlate">{{ ucfirst($log->action) }}</p>
                                </div>
                                <div class="col-span-1">
                                    <label class="text-xs font-bold tracking-widest uppercase text-slateGray">Entity Type</label>
                                    <p class="text-lg font-semibold text-darkSlate">{{ ucfirst($log->entity_type) }}</p>
                                </div>
                                <div class="col-span-1">
                                    <label class="text-xs font-bold tracking-widest uppercase text-slateGray">Entity ID</label>
                                    <p class="text-lg font-semibold text-darkSlate">{{ $log->entity_id ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <div>
                        <h2 class="text-lg font-bold text-darkSlate mb-4">Description</h2>
                        <p class="text-slateGray">{{ $log->description ?? 'No description provided.' }}</p>
                    </div>

                    @if ($log->changes)
                        <hr class="border-gray-200">
                        <div>
                            <h2 class="text-lg font-bold text-darkSlate mb-4">Changes Made</h2>
                            <div class="bg-gray-50 rounded-lg p-4 overflow-x-auto">
                                <pre class="text-sm text-slateGray"><code>{{ json_encode($log->changes, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</code></pre>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                    <div>
                        <label class="text-xs font-bold tracking-widest uppercase text-slateGray">Admin</label>
                        <p class="text-lg font-semibold text-darkSlate mt-1">
                            {{ $log->admin ? $log->admin->first_name . ' ' . $log->admin->last_name : 'System' }}
                        </p>
                        @if ($log->admin)
                            <p class="text-sm text-slateGray">{{ $log->admin->email }}</p>
                        @endif
                    </div>

                    <hr class="border-gray-200">

                    <div>
                        <label class="text-xs font-bold tracking-widest uppercase text-slateGray">IP Address</label>
                        <p class="text-sm text-darkSlate mt-1">{{ $log->ip_address ?? 'Not recorded' }}</p>
                    </div>

                    <hr class="border-gray-200">

                    <div>
                        <label class="text-xs font-bold tracking-widest uppercase text-slateGray">Timestamp</label>
                        <p class="text-sm text-darkSlate mt-1">{{ $log->created_at->format('M d, Y H:i:s') }}</p>
                        <p class="text-xs text-slateGray mt-1">{{ $log->created_at->diffForHumans() }}</p>
                    </div>

                    <hr class="border-gray-200">

                    <div class="text-xs text-slateGray space-y-1">
                        <p><strong>User Agent:</strong></p>
                        <p class="break-words">{{ $log->user_agent ?? 'Not recorded' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-xs text-slateGray mt-8">&copy; 2026 Training Management System. All rights reserved.</footer>

</body>
</html>
