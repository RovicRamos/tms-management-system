<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="max-w-lg w-full bg-white p-10 rounded-2xl shadow-lg">
        <h2 class="text-3xl font-bold text-center mb-8">Create Account</h2>

        <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold">First Name</label>
                    <input type="text" name="first_name" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold">Last Name</label>
                    <input type="text" name="last_name" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-semibold">Phone</label>
                <input type="tel" name="phone" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-semibold">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500">
            </div>

            <button type="submit" class="w-full bg-orange-600 text-white py-3 rounded-xl font-bold hover:bg-orange-700 transition">
                Register Account
            </button>
        </form>
    </div>

</body>
</html>