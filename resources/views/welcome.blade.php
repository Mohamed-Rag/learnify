<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="website icon" type="png" href="{{ asset('images/Logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/nav_bar_before.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home-before.css') }}">
</head>
<body>
    <div class="navbar">
        <a href="{{ url('') }}" class="logo">
            <img src="{{ asset('images/Logo.png') }}" alt="Learnify Logo">
            <span>Learnify</span>
        </a>

        <div class="right-section">
            <a href="{{ route('login') }}" style="text-decoration: none;">
                    <button class="nav-button login-btn">Login</button>
            </a>
            <a href="{{ route('register') }}" style="text-decoration: none;">
                <button class="nav-button signup-btn">Sign up</button>
            </a>
        </div>
    </div>

    <div class="content">
        <div class="text-content">
            <h1>Unlock Your Potential with <span style="color: #860000;">Learnify</span></h1>
            <p>Join us for an engaging and comprehensive learning experience designed to help you. Whether you're a beginner or looking to deepen your knowledge, this website provides expert guidance, interactive lessons, and hands-on practice to ensure success.</p>
        </div>
        <div class="cat">
            <img src="{{ asset('images/cat.png') }}" alt="cat">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
