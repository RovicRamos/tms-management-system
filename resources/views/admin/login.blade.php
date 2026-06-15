<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Admin Login</title>
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
<body class="bg-gray-50 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-sm border border-gray-200 p-8 space-y-6">
        <div class="text-center space-y-2">
            <a href="/" class="inline-block"><img src="/images/logo.png" alt="Logo" class="h-12 w-auto mx-auto object-contain"></a>
            <span class="inline-flex items-center text-xs font-semibold tracking-wider text-deepOcean uppercase bg-iceBlue px-3 py-1 rounded-full">Administrator Access</span>
            <h2 class="text-2xl font-bold text-gray-900">Sign in to the admin dashboard</h2>
            <p class="text-sm text-gray-500">Use an administrator account to manage the platform.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.authenticate') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm">
            </div>

            <button type="submit" class="w-full bg-deepOcean text-white font-semibold py-2 rounded-lg hover:bg-softMutedTeal transition">Log In</button>
        </form>

        <p class="text-center text-sm text-gray-500 pt-2">
            Need client access? <a href="{{ route('login') }}" class="text-teal-600 font-semibold hover:underline">Use the regular login</a>
        </p>
    </div>

</body>
</html>