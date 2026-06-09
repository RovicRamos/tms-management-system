<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Create Account</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
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
                        slateGray: '#5B7582',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white font-sans antialiased text-gray-900 min-h-screen flex flex-col justify-between">

    <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center w-full">
        <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
            <img src="{{ asset('images/logo.png') }}" 
                 alt="Global Seminar App Logo" 
                 class="h-9 w-auto object-contain">
            
            <span class="text-2xl font-black tracking-wider text-deepOcean group-hover:text-softOrange transition">
                TSM SYSTEM
            </span>
        </a>
    </header>

    <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-lg w-full space-y-8 bg-white border border-gray-100 p-8 sm:p-10 rounded-2xl shadow-sm">
            
            <div class="text-center space-y-2">
                <h2 class="text-3xl font-extrabold text-darkSlate tracking-tight">
                    Get Started
                </h2>
                <p class="text-sm text-slateGray">
                    Create your personal account to register and track training modules
                </p>
            </div>

            <form class="mt-8 space-y-6" action="#" method="POST">
                @csrf 
                
                <div class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-semibold text-darkSlate">First Name</label>
                            <input id="first_name" name="first_name" type="text" required 
                                class="mt-1 block w-full px-4 py-3 rounded-xl bg-white border border-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-softOrange focus:border-transparent transition text-sm" 
                                placeholder="John">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-semibold text-darkSlate">Last Name</label>
                            <input id="last_name" name="last_name" type="text" required 
                                class="mt-1 block w-full px-4 py-3 rounded-xl bg-white border border-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-softOrange focus:border-transparent transition text-sm" 
                                placeholder="Doe">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-darkSlate">Email Address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="mt-1 block w-full px-4 py-3 rounded-xl bg-white border border-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-softOrange focus:border-transparent transition text-sm" 
                            placeholder="name@example.com">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-darkSlate">Phone Number</label>
                        <input id="phone" name="phone" type="tel" 
                            class="mt-1 block w-full px-4 py-3 rounded-xl bg-white border border-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-softOrange focus:border-transparent transition text-sm" 
                            placeholder="09123456789">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-darkSlate">Password</label>
                        <input id="password" name="password" type="password" required 
                            class="mt-1 block w-full px-4 py-3 rounded-xl bg-white border border-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-softOrange focus:border-transparent transition text-sm" 
                            placeholder="Minimum 8 characters">
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox" required
                            class="h-4 w-4 text-deepOcean focus:ring-softOrange border-gray-300 rounded">
                    </div>
                    <label for="terms" class="ml-2 block text-sm text-slateGray select-none">
                        I certify that the information provided above is accurate and complete.
                    </label>
                </div>

                <div>
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-softOrange hover:bg-terracotta focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-softOrange shadow-md transition">
                        Register Account
                    </button>
                </div>
            </form>

            <div class="text-center pt-2">
                <p class="text-sm text-slateGray">
                    Already registered? 
                    <a href="{{ route('login') }}" class="font-bold text-deepOcean hover:text-softOrange transition">Sign in here</a>
                </p>
            </div>

        </div>
    </main>

    <footer class="py-6 text-center text-xs text-slateGray border-t border-gray-50 bg-white">
        &copy; 2026 Training Management System (TMS ADMIN). All rights reserved.
    </footer>

</body>
</html>