<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f5f5f5; margin: 0; padding: 0; }
        .wrapper { max-width: 560px; margin: 40px auto; padding: 20px; }
        .card { background: white; border-radius: 12px; padding: 40px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .logo { text-align: center; margin-bottom: 24px; }
        .logo img { height: 48px; }
        h1 { font-size: 22px; text-align: center; color: #1a1a1a; margin-bottom: 12px; }
        p { font-size: 15px; color: #555; line-height: 1.6; margin-bottom: 24px; }
        .btn { display: inline-block; background: #0d9488; color: white; text-decoration: none; padding: 14px 32px; border-radius: 8px; font-weight: 600; font-size: 15px; }
        .btn:hover { background: #0f766e; }
        .footer { text-align: center; margin-top: 32px; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <h1>Verify Your Email Address</h1>
            <p>Thank you for creating an account. Please click the button below to verify your email address and activate your account.</p>
            <div style="text-align: center; margin-bottom: 24px;">
                <a href="{{ $verificationUrl }}" class="btn">Verify Email Address</a>
            </div>
            <p style="font-size: 13px; color: #888;">If you did not create an account, no further action is required. If you're having trouble clicking the button, copy and paste the URL below into your web browser:</p>
            <p style="font-size: 12px; color: #666; word-break: break-all;">{{ $verificationUrl }}</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
