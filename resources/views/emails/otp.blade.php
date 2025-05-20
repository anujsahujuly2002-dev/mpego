<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4f46e5;
            padding: 20px;
            text-align: center;
            color: white;
            font-size: 24px;
        }
        .body {
            padding: 30px;
            text-align: center;
            color: #555;
        }
        .otp {
            font-size: 36px;
            font-weight: bold;
            color: #4f46e5;
            padding: 10px 20px;
            background-color: #f0f4ff;
            border-radius: 6px;
            display: inline-block;
            margin: 20px 0;
        }
        .footer {
            background-color: #f7f7f7;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
        .footer a {
            color: #4f46e5;
            text-decoration: none;
        }
        .button {
            padding: 10px 20px;
            background-color: #4f46e5;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            {{ config('app.name') }}
        </div>
        <div class="body">
            <h2>Hello {{ $user->name ?? 'User' }},</h2>
            <p>We’ve received a request to send you an OTP (One-Time Password) to verify your identity.</p>
            <p>Your OTP is:</p>
            <div class="otp">{{ $otp }}</div>
            <p>This OTP will expire in 10 minutes. Please make sure to use it within that time.</p>
            <p>If you did not request this, please <a href="#">contact us</a>.</p>
            {{-- <a href="#" class="button">Verify Now</a> --}}
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
