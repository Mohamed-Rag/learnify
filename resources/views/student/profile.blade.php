<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - Learnify</title>
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

        .container {
            width: 90%;
            max-width: 800px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            margin: 30px auto;
        }

        .card {
            background-color: rgb(18, 18, 18);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .profile-name {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
            color: rgb(255, 255, 255);
        }

        .profile-info {
            display: flex;
            align-items: center;
            margin: 15px 0;
            padding: 12px 20px;
            background-color: rgba(30, 30, 30, 0.8);
            border-radius: 8px;
            transition: background-color 0.2s ease;
            color: rgb(255, 255, 255);
        }

        .profile-info:hover {
            background-color: rgba(42, 42, 42, 0.8);
        }

        .profile-info i {
            color: #860000;
            margin-right: 15px;
            width: 20px;
            font-size: 18px;
        }

        .courses-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #333;
        }

        .courses-title {
            font-size: 24px;
            font-weight: 600;
            color: #fff;
        }

        .add-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: #860000;
            border: none;
            border-radius: 50%;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .add-button:hover {
            background-color: #a30000;
            transform: scale(1.1);
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

        .no-courses {
            padding: 20px;
            text-align: center;
            color: #888;
            font-style: italic;
        }

        .course-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }

        .course {
            background-color: rgba(30, 30, 30, 0.8);
            border-radius: 10px;
            padding: 20px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .course:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(134, 0, 0, 0.3);
        }

        .course h4 {
            color: #fff;
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .course p {
            color: #ccc;
            font-size: 14px;
            line-height: 1.5;
        }

        .course-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .course-icon {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            float: right;
            margin-left: 10px;
        }

        .course-icon-placeholder {
            font-size: 32px;
            color: #860000;
            float: right;
            margin-left: 10px;
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

    <div class="container">
        <div class="card">
            <div class="profile-name">{{ Auth::user()->name }}</div>
            <div class="profile-info">
                <i class="fas fa-envelope"></i>
                <span>{{ Auth::user()->email }}</span>
            </div>
            <div class="profile-info">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ Auth::user()->country }}</span>
            </div>
            <div class="profile-info">
                <i class="fas fa-phone"></i>
                <span>{{ Auth::user()->phone }}</span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
