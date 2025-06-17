<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
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
        .button {
            padding: 10px 20px;
            background-color: #4f46e5;
            color: white; /* ← Change this line */
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
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
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            {{ config('app.name') }}
        </div>
        <div class="body">
            <h2>Hello {{ $userName ?? 'User' }},</h2>
            <p>We received a request to reset your password.</p>
            <p>If you made this request, click the button below to reset your password:</p>
            <a href="{{ $forgetPasswordLink }}" class="button" style="padding: 10px 20px; background-color: #4f46e5; color: white; border-radius: 5px; text-decoration: none; display: inline-block; font-weight: bold;">Reset Password</a>
            <p>This link will expire in 60 minutes for your security.</p>
            <p>If you did not request a password reset, no further action is required.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
