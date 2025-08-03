
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Happy Birthday</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .email-header {
            background-color: #64c01c;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
        }

        .email-body {
            padding: 30px;
            text-align: center;
        }

        .email-body h2 {
            color: #333333;
        }

        .email-body p {
            font-size: 16px;
            color: #555555;
        }

        .cta-button {
            display: inline-block;
            margin-top: 20px;
            padding: 15px 30px;
            background-color: #28a745;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .email-footer {
            background-color: #f9f9f9;
            color: #888888;
            font-size: 13px;
            padding: 20px;
            text-align: center;
        }

        @media only screen and (max-width: 600px) {
            .email-body {
                padding: 20px;
            }

            .cta-button {
                padding: 12px 25px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🎉 Happy Birthday, {{ $user->name }}!</h1>
        </div>
        <div class="email-body">
            <h2>We’ve Got a Surprise for You!</h2>
            <p>To celebrate your special day, we’ve prepared a secret gift just for you. Click the button below to  scratch and reveal your birthday surprise!</p>
            @if ($giftCardScratch)
                <a href="{{route('admin.gift.token',$token)}}" class="cta-button">\🎁 Scratch Your Gift</a>
            @endif
            <p style="margin-top: 30px;">Enjoy your day and thank you for being with us.</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
            This is an automated message. Please do not reply.
        </div>
    </div>
</body>
</html>
