<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>learnify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
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

    .navbar .right-section {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .navbar .right-section a {
        color: white;
        text-decoration: none;
        margin-right: 15px;
    }
    .navbar {
        background-color: rgba(18, 18, 18, 0.95);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(134, 0, 0, 0.2);
    }

    .card {
        margin-top: 20px;
        color: #ffffff;
        background-color: rgba(18, 18, 18, 0.95);
        backdrop-filter: blur(15px);
        border-radius: 15px;
        border: 1px solid rgba(134, 0, 0, 0.2);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        transition: all 0.3s ease;
        overflow: hidden;
        padding: 0;
    }

    .card:hover {
        transform: translateY(-5px);
        border-color: rgba(134, 0, 0, 0.4);
        box-shadow: 0 8px 32px rgba(134, 0, 0, 0.2);
    }

    .card-header {
        background: linear-gradient(135deg, #860000, #630000);
        color: #ffffff;
        padding: 20px;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .card-header::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 150px;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1));
        transform: skewX(-15deg);
    }

    .card-body {
        background-color: rgba(18, 18, 18, 0.95);
        padding: 25px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #860000, #630000);
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #a30000, #860000);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(134, 0, 0, 0.4);
    }

    .enrollment-date {

        padding: 12px 15px;
        margin-bottom: 20px;
    }

    .enrollment-date i {
        color: #a30000;
        margin-right: 10px;
    }

    .alert-info {
        background-color: rgba(18, 18, 18, 0.95);
        border: 1px solid rgba(134, 0, 0, 0.3);
        color: #ffffff;
        backdrop-filter: blur(15px);
        padding: 35px;
        text-align: center;
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
    }

    .main-header {
        color: #ffffff;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 40px;
    }

    .right-section a {
        color: rgba(255, 255, 255, 0.8);
        transition: color 0.3s ease;
    }

    .right-section a:hover {
        color: #ffffff;
    }

    .btn-danger {
        background: linear-gradient(135deg, #860000, #630000);
        border: none;
        padding: 8px 16px;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #a30000, #860000);
        transform: translateY(-2px);
    }
</style>
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
        <h1 class="main-header">My Enrolled Courses</h1>

        <div class="row justify-content-center">
            <div class="col-md-10">
                @if(count($enrollments) > 0)
                    <div class="row">
                        @foreach($enrollments as $enrollment)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0" title="{{ $enrollment->course->course_name }}">
                                            {{ $enrollment->course->course_name }}
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="enrollment-date">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>Enrolled: {{ $enrollment->enrollment_date->format('F j, Y') }}</span>
                                        </div>
                                        <a href="{{ route('student.course.details', ['id' => $enrollment->course_id]) }}"
                                           class="btn btn-primary w-100">
                                            <i class="fas fa-play-circle"></i> Start Learning
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                        <p class="mb-4">You haven't enrolled in any courses yet.</p>
                        <a href="{{ route('student.all.courses') }}" class="btn btn-primary">
                            <i class="fas fa-search"></i> Browse Courses
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
