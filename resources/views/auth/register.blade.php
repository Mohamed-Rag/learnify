<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up - Learnify</title>
    <link rel="icon" type="image/png" href="{{ asset('/images/Logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #121212;
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

        .role-selection {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }

        .role-option {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #fff;
            cursor: pointer;
        }

        .role-option input[type="radio"] {
            width: auto;
            margin: 0;
        }

        .signup-btn {
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

        .signup-btn:hover {
            background-color: #600000;
            transition: background-color 0.3s;
        }

        .login-text {
            margin-top: 20px;
            color: #fff;
            font-size: 14px;
        }

        .login-text a {
            color: #ff0000;
            text-decoration: none;
            font-weight: bold;
        }

        .error {
            color: #ff0000;
            font-size: 12px;
            text-align: left;
            margin-top: 5px;
        }

        .input-row {
            display: flex;
            gap: 10px;
            margin: 10px 0;
            width: 100%;
        }

        .input-container {
            flex: 1;
        }

        .input-container input {
            width: 100%;
            margin: 0;
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
        <h1>Hello There !</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="Full Name" required value="{{ old('name') }}">
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror

            <input type="email" name="email" placeholder="Enter your email" required value="{{ old('email') }}">
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror

            <input type="password" name="password" placeholder="Enter your password" required>
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror

            <input type="password" name="password_confirmation" placeholder="Confirm your password" required>

            <div class="input-row">
                <div class="input-container">
                    <input type="text" name="phone" placeholder="Phone Number" required value="{{ old('phone') }}">
                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-container">
                    <input type="text" name="country" placeholder="Country" required value="{{ old('country') }}">
                    @error('country')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="role-selection">
                <label class="role-option">
                    <input type="radio" name="role" value="student" checked>
                    <span>Student</span>
                </label>
                <label class="role-option">
                    <input type="radio" name="role" value="teacher">
                    <span>Instructor</span>
                </label>
            </div>

            <button type="submit" class="signup-btn">Sign Up</button>
        </form>

        <div class="login-text">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>

</body>
</html>
