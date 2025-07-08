<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Security Check</title>
    <script src="https://www.google.com/recaptcha/api.js " async defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .message-box {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .g-recaptcha {
            margin: 20px auto;
            display: inline-block;

        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-box {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
    font-size: 14px;
}

    </style>
</head>
<body>

<div class="container">

    <div class="message-box">
        Prove you're not a robot.
    </div>

        @if ($errors->has('g-recaptcha-response'))
            <div class="error-box">
                {{ $errors->first('g-recaptcha-response') }}
            </div>
        @endif

    <form method="POST" action="{{ url('/security-check') }}">
        @csrf

        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>

        <br><br>
        <button type="submit">Continue</button>
    </form>



            

</div>

</body>
</html>
