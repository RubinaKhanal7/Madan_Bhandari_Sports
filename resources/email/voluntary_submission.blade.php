<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Voluntary Record Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }
        h3 {
            color: #333;
        }
        p {
            color: #555;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>You have received a new message from your website:</h3>
        <p><strong>Name:</strong> {{ $name }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><a href="{{ $verificationUrl }}">Click here to verify your email</a></p>
    </div>
</body>
</html>