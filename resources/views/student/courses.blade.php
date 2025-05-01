<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->category_name }} Courses - Learnify</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/nav_bar_before.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home-before.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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
        .courses-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        .courses-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .courses-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: white;
        }

        .category-image-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .category-image-header img {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            margin-right: 20px;
            object-fit: cover;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        .course-card {
            background-color: rgba(45, 45, 45, 0.8);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .course-card:hover {
            transform: translateY(-5px);
        }


        .btn-primary
        {
            background-color: #860000;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #a50000;
        }


        .course-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .course-info {
            padding: 20px;
        }

        .course-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: white;
        }

        .course-instructor {
            font-size: 0.9rem;
            color: #aaa;
            margin-bottom: 12px;
        }

        .course-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .enroll-btn {
            background-color: #860000;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .enroll-btn:hover {
            background-color: #a50000;
        }

        .view-details-btn {
            background-color: transparent;
            color: white;
            padding: 6px 14px;
            border: 1px solid white;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .view-details-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .no-courses {
            text-align: center;
            padding: 50px 0;
            font-size: 1.2rem;
            color: #aaa;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #aaa;
            text-decoration: none;
        }

        .back-link:hover {
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

    <div class="courses-container">
        <a href="{{ route('student.categories') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Categories
        </a>

        <div class="category-image-header">
            @if($category->image_path)
                <img src="{{ asset($category->image_path) }}" alt="{{ $category->category_name }}">
            @else
                <img src="{{ asset('images/imgs/' . strtolower($category->category_name) . '.png') }}" alt="{{ $category->category_name }}">
            @endif
            <h1 class="courses-title">{{ $category->category_name }} Courses</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($courses->count() > 0)
            <div class="courses-grid">
                @foreach($courses as $course)
                    <div class="course-card">
                        @if($course->image)
                            <img src="{{ asset($course->image) }}" alt="{{ $course->course_name }}" class="course-image">
                        @else
                            <img src="{{ asset('images/course-placeholder.jpg') }}" alt="{{ $course->course_name }}" class="course-image">
                        @endif
                        <div class="course-info">
                            <h3 class="course-title">{{ $course->course_name }}</h3>
                            <p class="course-instructor">Instructor: {{ $course->user->name }}</p>
                            <div class="course-details">
                                <div class="card-footer">
                                    @php
                                        $hasActiveSubscription = Auth::check() && \App\Models\Subscription::where('user_id', Auth::id())
                                            ->where('status', 'active')
                                            ->where('end_date', '>=', now())
                                            ->exists();

                                        $isEnrolled = Auth::check() && \App\Models\Enrollment::where('user_id', Auth::id())
                                            ->where('course_id', $course->id)
                                            ->exists();
                                    @endphp

                                    @if($isEnrolled)
                                        <button class="btn btn-success" disabled>Enrolled</button>
                                    @elseif($hasActiveSubscription)
                                        <form action="{{ route('enrollment.enroll', ['course_id' => $course->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Enroll Now</button>
                                        </form>
                                    @else
                                        <a href="{{ route('subscription.plans') }}" class="btn btn-warning">Subscribe to Enroll</a>
                                    @endif
                                </div>
                                <a href="{{ route('student.course.details', ['id' => $course->id]) }}" class="view-details-btn">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-courses">
                <p>No courses available in this category yet.</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
