<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Log In</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-sm border border-gray-200 p-8 space-y-6">
        <div class="text-center space-y-2">
            <a href="/" class="inline-block"><img src="/images/logo.png" alt="Logo" class="h-12 w-auto mx-auto object-contain"></a>
            <h2 class="text-2xl font-bold text-gray-900">Sign in to your account</h2>
            <p class="text-sm text-gray-500">Welcome back to the Training Management System</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-4">
    @csrf
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm">
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm">
    </div>

    <button type="submit" class="w-full bg-teal-600 text-white font-semibold py-2 rounded-lg">Log In</button>
</form>

        <p class="text-center text-sm text-gray-500 pt-2">
            Don't have an account? <a href="/register" class="text-teal-600 font-semibold hover:underline">Create an account</a>
        </p>
    </div>

</body>
</html>