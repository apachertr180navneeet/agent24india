<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Email OTP</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <h2>Hello 👋</h2>

    <p>Your OTP for verification is:</p>

    <h1 style="letter-spacing:5px;">{{ $otp }}</h1>

    <p>This OTP is valid for <b>5 minutes</b>.</p>

    <p>If you didn’t request this, please ignore this email.</p>

    <br>
    <p>Thanks,<br><b>{{ config('app.name') }}</b></p>
</body>
</html>
