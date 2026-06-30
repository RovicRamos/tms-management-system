<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS | Verify Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="max-w-lg w-full bg-white p-10 rounded-2xl shadow-lg text-center">
        <div class="text-5xl mb-6">📧</div>
        <h2 class="text-3xl font-bold mb-4">Verify Your Email</h2>

        @if (session('status'))
            <div class="bg-teal-50 text-teal-700 p-4 rounded-lg text-sm mb-6">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-6">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <p class="text-gray-600 mb-6">
            A verification link has been sent to <strong>{{ session('verification_email') }}</strong>.
            Please check your inbox and click the link to activate your account.
        </p>

        <p class="text-gray-500 text-sm mb-6">If you did not receive the email, click the button below to resend.</p>

        <form action="{{ route('verification.resend') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-teal-600 text-white py-3 rounded-xl font-bold hover:bg-teal-700 transition">
                Resend Verification Email
            </button>
        </form>

        <p class="text-sm text-gray-500 mt-6">
            <a href="{{ route('login') }}" class="text-teal-600 font-semibold hover:underline">Back to Login</a>
        </p>
    </div>

</body>
</html>
