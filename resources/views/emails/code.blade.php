<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Detailing Booking System 2FA Login Verification</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .code {
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
        .footer p {
            margin: 5px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vehicle Detailing Booking System Login Verification</h1>
        <div class="code">{{ $details['code'] }}</div>
        <p>Hello {{ auth()->user()->name }},</p>
        <p>A login attempt was made on your Vehicle Detailing Booking System account. To ensure the security of your account, please use the following verification code:</p>
        <p><strong>{{ $details['code'] }}</strong></p>
        <p>If you did not initiate this login request, please disregard this message.</p>
        <div class="footer">
            <p>Thank you for using Vehicle Detailing Booking System!</p>
        </div>
    </div>
</body>
</html>
