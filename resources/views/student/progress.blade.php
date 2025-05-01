<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify</title>

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
        .navbar .logo img {
            height: 35px;
            margin-right: 10px;
        }
        .navbar .menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .navbar .menu a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }
        .subscribe-btn {
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
        .subscribe-btn:hover {
            background-color: #a50000;
        }
        .navbar .right-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .search-container {
            position: relative;
        }
        .search {
            padding: 8px 16px;
            border-radius: 20px;
            border: none;
            background-color: #3d3d3d;
            color: white;
            width: 240px;
        }
        .search::placeholder {
            color: #aaa;
        }
        .nav-icons {
            display: flex;
            gap: 15px;
        }
        .nav-icon {
            color: white;
            font-size: 18px;
            cursor: pointer;
        }
        .dropdown-menu {
            background-color: #2d2d2d;
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .dropdown-item {
            color: white;
        }
        .dropdown-item:hover {
            background-color: #3d3d3d;
            color: white;
        }
        .dropdown-divider {
            border-color: #444;
        }

        /* Course Content Styles */
        .course-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .course-video {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        #courseVideo {
            width: 100%;
            height: auto;
            max-height: 600px;
            background-color: #000;
        }
        .course-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }
        .course-info {
            flex: 1;
            min-width: 300px;
        }
        .course-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            color: white;
        }
        .instructor-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .instructor-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        .course-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 15px;
        }
        .meta-item {
            display: flex;
            align-items: center;
            color: #aaa;
        }
        .meta-item i {
            margin-right: 8px;
        }
        .course-actions {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: flex-end;
        }
        .subscribe-button {
            background-color: #860000;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            width: 200px;
        }
        .subscribe-button:hover {
            background-color: #a50000;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-button {
            background-color: transparent;
            color: white;
            border: 1px solid white;
            border-radius: 8px;
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .action-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .course-content {
            margin-top: 40px;
        }
        .course-objectives {
            background-color: rgba(45, 45, 45, 0.8);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
        }
        .course-objectives h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: white;
        }
        .objectives-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .objectives-list li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        .objectives-list li i {
            color: #860000;
            margin-right: 10px;
            margin-top: 5px;
        }

        .course-description {
            background-color: rgba(45, 45, 45, 0.8);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
        }
        .course-description h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: white;
        }

        .course-syllabus {
            background-color: rgba(45, 45, 45, 0.8);
            border-radius: 12px;
            padding: 30px;
        }
        .course-syllabus h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: white;
        }
        .syllabus-section {
            margin-bottom: 20px;
        }
        .syllabus-section h3 {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 10px;
            color: white;
        }
        .syllabus-lessons {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .syllabus-lesson {
            display: flex;
            justify-content: space-between;
            padding: 12px 15px;
            border-bottom: 1px solid #444;
            align-items: center;
        }
        .syllabus-lesson:last-child {
            border-bottom: none;
        }
        .lesson-title {
            display: flex;
            align-items: center;
        }
        .lesson-title i {
            margin-right: 10px;
            color: #aaa;
        }
        .lesson-duration {
            color: #aaa;
            font-size: 14px;
        }

        .support {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 100;
        }
        .support button {
            background-color: #860000;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .support button:hover {
            background-color: #a50000;
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
                <a href="{{ route('student.dashboard') }}">Home</a>
                <a href="{{ route('student.profile') }}">Profile</a>
                <a href="{{ route('student.categories') }}">Browse Courses</a>
                <a class="nav-link" href="{{ route('student.progress') }}">My Progress</a>
                <a class="nav-link" href="{{ route('enrollment.my') }}">My Enrollments</a>
                <a class="nav-link" href="{{ route('subscription.plans') }}">Subscription Plans</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">My Learning Progress</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h5>Your Enrolled Courses</h5>

                        @if($enrollments->count() > 0)
                            <div class="row">
                                @foreach($enrollments as $enrollment)
                                    @php
                                        $course = $enrollment->course;
                                        $totalVideos = $course->videos->count();
                                        $completedVideos = \App\Models\VideoProgress::where('user_id', Auth::id())
                                            ->whereIn('video_id', $course->videos->pluck('id'))
                                            ->where('completed', true)
                                            ->count();
                                        $courseProgress = $totalVideos > 0 ? ($completedVideos / $totalVideos) * 100 : 0;

                                        // Find the last watched video
                                        $lastWatched = \App\Models\VideoProgress::where('user_id', Auth::id())
                                            ->whereIn('video_id', $course->videos->pluck('id'))
                                            ->orderBy('last_watched_at', 'desc')
                                            ->first();
                                    @endphp

                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="card-header">
                                                <h5 class="mb-0">{{ $course->course_name }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between">
                                                        <span>Progress: {{ round($courseProgress) }}%</span>
                                                        <span>{{ $completedVideos }}/{{ $totalVideos }} videos</span>
                                                    </div>
                                                    <div class="progress mt-2" style="height: 10px;">
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ $courseProgress }}%;"
                                                            aria-valuenow="{{ $courseProgress }}"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($lastWatched && $lastWatched->video)
                                                    <p class="card-text">Last watched: {{ $lastWatched->video->title }}</p>
                                                    <a href="{{ route('student.watch.video', ['videoId' => $lastWatched->video_id]) }}"
                                                       class="btn btn-primary">
                                                        Resume Learning
                                                    </a>
                                                @elseif($course->videos->count() > 0)
                                                    <a href="{{ route('student.watch.video', ['videoId' => $course->videos->first()->id]) }}"
                                                       class="btn btn-primary">
                                                        Start Learning
                                                    </a>
                                                @else
                                                    <p class="card-text text-muted">No videos available yet.</p>
                                                @endif

                                                <a href="{{ route('student.course.details', ['id' => $course->id]) }}"
                                                   class="btn btn-outline-secondary ml-2">
                                                    Course Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                <p>You haven't enrolled in any courses yet.</p>
                                <a href="{{ route('student.all.courses') }}" class="btn btn-primary">Browse Courses</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
