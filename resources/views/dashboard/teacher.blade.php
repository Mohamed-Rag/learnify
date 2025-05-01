<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background-color: rgba(45, 45, 45, 0.8);
            backdrop-filter: blur(5px);
            position: sticky;
            top: 0;
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

        .navbar .menu a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            margin-right: 20px;
            transition: color 0.2s;
        }

        .navbar .menu a:hover {
            color: #888;
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

        .menu a.active {
            color: #888;
            font-weight: 600;
        }

    </style>
</head>
<body>
    <div class="navbar">
        <a href="{{ route('teacher.dashboard') }}" class="logo">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo" style="height: 35px; margin-right: 10px;">
            Learnify
        </a>
        <div class="menu">
            <a href="{{ route('teacher.dashboard') }}" class="active">Home</a>
            <a href="{{ route('teacher.profile') }}">Profile</a>
            <a href="{{ route('teacher.managecourses') }}">Manage Courses</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">Logout</button>
            </form>
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
