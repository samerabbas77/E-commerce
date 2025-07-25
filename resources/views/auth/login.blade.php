<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            
        }

        .container {
            display: flex;
            width: 100%;
            height: 100%;
            border-radius: 0;
            overflow: hidden;
            position: relative;
            
        }

        .container::before {
            content: '';
            position: absolute;
            width: 150%;
            height: 150%;
            background: linear-gradient(135deg, #ff7e5f 50%, transparent 50%);
            z-index: 1;
            transform: rotate(-45deg);
            transform-origin: top left;
            
        }

        .left {
            flex: 1;
            background-size: cover;
            background-position: center;
            /* z-index: 2; */
            background-image: url("{{ asset('admin/img/background.jpg') }}");

        }

        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2;
            /* background: #fff; */
            background-image: url("{{ asset('admin/img/background.jpg') }}");

        }

        .login-container {
            padding: 30px 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            z-index: 3;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #ff7e5f;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #feb47b;
        }

        .login-container .form-footer {
            margin-top: 20px;
        }

        .login-container .form-footer a {
            color: #ff7e5f;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left"></div>
        <div class="right">
            <div class="login-container">
                <h2>Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="email" name="email" placeholder="Email" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="password" name="password" placeholder="Password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit">Login</button>
                </form>
                <div class="form-footer">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    @endif
<br>
<br>
                                    {{-- <a href="{{route('register')}}">Create an Account</a> --}}
            @if ($errors->any())
                <div style="color: #856404; margin-bottom: 15px; border: 1px solid #ffeeba; padding: 10px; border-radius: 5px; background-color: #fff3cd;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                </div>
            </div>
        </div>
    </div>
</body>
</html>