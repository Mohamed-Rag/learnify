{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Learnify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #121212;
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .red-curves {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .container {
            background-color: rgba(26, 26, 26, 0.95);
            padding: 40px;
            border-radius: 20px;
            width: 400px;
            text-align: center;
            box-shadow: 0 0 20px rgba(134, 0, 0, 0.5);
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            gap: 10px;
        }

        .logo img {
            width: 40px;
            height: 40px;
        }

        .logo span {
            font-size: 24px;
            font-weight: bold;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        input {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            border: none;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 16px;
            box-sizing: border-box;
        }

        input::placeholder {
            color: #888;
        }

        .login-btn {
            background-color: #860000;
            color: white;
            padding: 15px;
            width: 100%;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            font-weight: bold;
        }
        .login-btn:hover {
            background-color: #600000;
            transition: background-color 0.3s;
        }

        .forgot-password {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            margin-top: 20px;
            display: block;
        }

        .signup-text {
            margin-top: 20px;
            color: #fff;
            font-size: 14px;
        }

        .signup-text a {
            color: #ff0000;
            text-decoration: none;
            font-weight: bold;
        }

        .remember-me {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin: 15px 0;
            gap: 8px;
        }

        .remember-me input[type="checkbox"] {
            width: auto;
            margin: 0;
            cursor: pointer;
        }

        .remember-me label {
            color: #888;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="logo">
            <a href="{{ route('welcome') }}" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 10px;">
                <img src="{{ asset('/images/Logo.png') }}" alt="Learnify Logo">
                <span>Learnify</span>
            </a>
        </div>
        <h1>Welcome back !</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Enter your email" required value="{{ old('email') }}">
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror

            <input type="password" name="password" placeholder="Enter your password" required>
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror

            <button type="submit" class="login-btn">Login</button>
        </form>

        <a href="{{ route('password.request') }}" class="forgot-password">Forgot your password?</a>

        <div class="signup-text">
            Don't have an account? <a href="{{ route('register') }}">Sign up</a>
        </div>
    </div>

</body>
</html>
