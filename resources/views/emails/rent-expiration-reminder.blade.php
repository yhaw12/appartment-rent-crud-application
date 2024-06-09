<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Expiration Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .content {
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #7f7f7f;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            {{-- <img src="{{ asset('path/to/your/logo.png') }}" alt="Logo" width="100"> --}}
            <img class="w-52" src="{{ url('/rentals.png') }}" alt="logo">
            <h1>Rent Expiration Reminder</h1>
        </div>
        <div class="content">
            <p>Dear Administrator,</p>
            <p>
                This is a reminder that the rent for the tenant <strong>{{ $tennant->tenant_name }}</strong> in house <strong>{{ $tennant->house }}</strong> (apartment {{ $tennant->appartment ?? 'N/A' }}) will expire in 3 months.
            </p>
            <p>
                Please take the necessary actions to renew the rent or inform the tenant about the upcoming expiration.
            </p>
            <p>
                Thank you for your attention.
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Your Company Name
        </div>
    </div>
</body>
</html>
