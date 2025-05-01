<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Categories - Learnify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/nav_bar_before.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home-before.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            min-height: 100vh;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 24px;
            background-color: #2d2d2d62;
            backdrop-filter: blur(5px);
            position: sticky;
            z-index: 1000;
        }
        .navbar .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }
        .navbar .logo img {
            height: 35px;
            margin-right: 10px;
        }

        .btn-danger{
            background-color: #860000;
            border: none;
            color: #fff;
            border-radius: 10px;
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-danger:hover {
            background-color: #a30000;
            transition: all 0.2s ease;
        }

        .navbar .right-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }


    .categories-container {
        max-width: 1200px;
        margin: 10px auto 40px;
        padding: 20px;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .categories-title {
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 40px;
        color: white;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-bottom: 30px;
    }

    .category-card {
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        backdrop-filter: blur(5px);
        transition: transform 0.2s;
    }

    .category-card:hover {
        transform: translateY(-5px);
    }

    .category-card a {
        text-decoration: none;
    }

    .category-image {
        width: 100%;
        height: auto;
        border-radius: 12px;
        margin-bottom: 15px;
        background-color: #404040;
        aspect-ratio: 1;
        object-fit: cover;
    }

    .category-name {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: white;
    }
</style>

</head>
<body>
    <div class="navbar">
        <a href="{{ route('student.dashboard') }}" class="logo">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo">
            Learnify
        </a>
        <div class="right-section">
            @auth
                <a class="nav-link" href="{{ route('student.dashboard') }}">Home</a>
                <a class="nav-link" href="{{ route('student.profile') }}">Profile</a>
                <a class="nav-link" href="{{ route('student.categories') }}">Browse Courses</a>
                <a class="nav-link" href="{{ route('enrollment.my') }}">My Enrollments</a>
                <a class="nav-link" href="{{ route('subscription.plans') }}">Subscription Plans</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Sign Up</a>
            @endauth
        </div>
    </div>

    <div class="categories-container">
        <h1 class="categories-title">Our Categories</h1>
        <div class="categories-grid">
            <div class="category-card">
                <a href="{{ route('student.courses', ['category_id' => 4]) }}">
                    <img src="{{ asset('images/imgs/ai.png') }}" class="category-image">
                    <h3 class="category-name">AI</h3>
                </a>
            </div>
            <div class="category-card">
                <a href="{{ route('student.courses', ['category_id' => 3]) }}">
                    <img src="{{ asset('images/imgs/back-end.png') }}" class="category-image">
                    <h3 class="category-name">Back-end</h3>
                </a>
            </div>
            <div class="category-card">
                <a href="{{ route('student.courses', ['category_id' => 2]) }}">
                    <img src="{{ asset('images/imgs/front-end.png') }}" class="category-image">
                    <h3 class="category-name">Front-end</h3>
                </a>
            </div>
            <div class="category-card">
                <a href="{{ route('student.courses', ['category_id' => 1]) }}">
                    <img src="{{ asset('images/imgs/cyber-security.png') }}" class="category-image">
                    <h3 class="category-name">Cyber security</h3>
                </a>
            </div>
            <div class="category-card">
                <a href="{{ route('student.courses', ['category_id' => 5]) }}">
                    <img src="{{ asset('images/imgs/game-dev.png') }}" class="category-image">
                    <h3 class="category-name">Game-Dev</h3>
                </a>
            </div>
            <div class="category-card">
                <a href="{{ route('student.courses', ['category_id' => 6]) }}">
                    <img src="{{ asset('images/imgs/human-being.png') }}" class="category-image">
                    <h3 class="category-name">Human-Being</h3>
                </a>
            </div>
            <div class="category-card">
                <a href="{{ route('student.courses', ['category_id' => 7]) }}">
                    <img src="{{ asset('images/imgs/data-analysis.png') }}" class="category-image">
                    <h3 class="category-name">Data analysis</h3>
                </a>
            </div>
            <div class="category-card">
                <a href="{{ route('student.courses', ['category_id' => 8]) }}">
                    <img src="{{ asset('images/imgs/problem-solving.png') }}" class="category-image">
                    <h3 class="category-name">Problem Solving</h3>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
