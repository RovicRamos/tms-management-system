<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Edit User</title>
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
                    <a href="{{ route('admin.notifications.index') }}" class="relative text-deepOcean hover:text-softMutedTeal transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        @php $unread = \App\Models\AdminNotification::where('is_read', false)->count(); @endphp
                        @if ($unread > 0)
                            <span class="absolute -top-1.5 -right-1.5 bg-crimson text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">{{ $unread > 9 ? '9+' : $unread }}</span>
                        @endif
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-xs font-bold text-crimson hover:text-white border border-crimson hover:bg-crimson px-3 py-1.5 rounded-lg transition duration-200">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
        @if ($errors->any())
            <div class="rounded-xl bg-red-50 text-red-600 border border-red-200 px-4 py-3 text-sm space-y-1">
                @foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach
            </div>
        @endif

        <section class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-sm">
            <div class="space-y-2">
                <span class="inline-flex items-center text-xs font-bold tracking-wider text-deepOcean uppercase bg-iceBlue px-3 py-1 rounded-full">User Management</span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-darkSlate tracking-tight">Edit User</h1>
                <p class="text-slateGray text-sm sm:text-base">Update account details and role.</p>
            </div>
        </section>

        <section class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-sm">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
                @csrf @method('PUT')
                <div class="grid gap-4 md:grid-cols-2">
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">First Name</label><input name="first_name" value="{{ old('first_name', $user->first_name) }}" class="w-full rounded-lg border-gray-300"></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label><input name="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full rounded-lg border-gray-300"></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded-lg border-gray-300"></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select name="role_id" class="w-full rounded-lg border-gray-300">
                            @foreach($roles as $role)
                                <option value="{{ $role->role_id }}" @selected(old('role_id', $user->role_id) == $role->role_id)>{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center gap-3 md:col-span-2">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active))>
                        <span class="text-sm text-gray-700">Account active</span>
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button class="bg-deepOcean text-white px-5 py-2.5 rounded-lg font-semibold">Save Changes</button>
                    <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-lg font-semibold text-deepOcean border border-gray-300 bg-white">Cancel</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>