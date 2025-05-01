<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->course_name }} - Course Details - Learnify</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">
    <style>
        :root {
            --primary: #9E1B32;
            --primary-hover: #B82741;
            --secondary: #1E1E24;
            --accent: #860000;
            --text-primary: #FFFFFF;
            --text-secondary: #E0E0E0;
            --dark-bg: #121212;
            --card-bg: #1E1E24;
            --card-gradient: linear-gradient(to bottom, #252530, #1E1E24);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark-bg);
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: var(--text-primary);
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
            font-size: 16px;
            transition: color 0.2s ease;
        }

        .navbar .right-section a:hover {
            color: var(--primary);
        }

        .btn-danger {
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

        .card {
            background: var(--card-gradient);
            color: var(--text-primary);
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

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
            color: var(--text-secondary);
        }

        .meta-item i {
            margin-right: 8px;
        }

        .progress {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .progress-bar {
            background: linear-gradient(to right, var(--primary), var(--primary-hover));
        }

        .list-group-item {
            background-color: var(--card-bg);
            color: var(--text-primary);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: background-color 0.2s;
        }

        .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: var(--text-secondary);
            text-decoration: none;
        }

        .back-link:hover {
            color: var(--text-primary);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-warning {
            background-color: var(--accent);
            border: none;
            color: #fff;
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
                <a href="{{ route('enrollment.my') }}">My Enrollments</a>
                <a href="{{ route('subscription.plans') }}">Subscription Plans</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Sign Up</a>
            @endauth
        </div>
    </div>

    <div class="course-container">
        <a href="{{ url()->previous() }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Courses
        </a>

        <div class="course-video">

                <img src="{{ $course->image ? asset($course->image) : asset('images/course-placeholder.jpg') }}" alt="{{ $course->course_name }}" style="width: 100%; height:650px; border-radius: 12px;">

        </div>

        <div class="course-header">
            <div class="course-info">
                <h1 class="course-title">{{ $course->course_name }}</h1>
                <div class="instructor-info">
                    <img src="{{ asset('images/user.png') }}" alt="Instructor">
                    <span>By {{ $course->user->name }}</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-footer p-3">
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
        </div>

        @if($isEnrolled)
        <div class="card">
            <div class="card-header">
                <h5>Course Content</h5>
                @php
                    $totalVideos = $course->videos->count();
                    $completedVideos = \App\Models\VideoProgress::where('user_id', Auth::id())
                        ->whereIn('video_id', $course->videos->pluck('id'))
                        ->where('completed', true)
                        ->count();
                    $courseProgress = $totalVideos > 0 ? ($completedVideos / $totalVideos) * 100 : 0;
                @endphp

                <div class="progress mt-2" style="height: 10px;">
                    <div class="progress-bar" role="progressbar" style="width: {{ $courseProgress }}%;"
                        aria-valuenow="{{ $courseProgress }}" aria-valuemin="0" aria-valuemax="100">
                        {{ round($courseProgress) }}%
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($course->videos->count() > 0)
                    <div class="list-group">
                        @foreach($course->videos as $video)
                            @php
                                $videoProgress = \App\Models\VideoProgress::where('user_id', Auth::id())
                                    ->where('video_id', $video->id)
                                    ->first();
                                $isCompleted = $videoProgress && $videoProgress->completed;
                            @endphp

                            <a href="{{ route('student.watch.video.simple', ['course_id' => $course->id, 'video_id' => $video->id]) }}"
                               class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        @if($isCompleted)
                                            <i class="fas fa-check-circle text-success"></i>
                                        @elseif($videoProgress)
                                            <i class="fas fa-play-circle text-primary"></i>
                                        @else
                                            <i class="far fa-circle"></i>
                                        @endif
                                        {{ $video->title }}
                                    </div>
                                    @if($video->duration)
                                        <small>{{ gmdate("i:s", $video->duration) }}</small>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p>No videos available for this course yet.</p>
                @endif
            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h2>Course Description</h2>
                <p>{{ $course->description ?? 'No description available for this course.' }}</p>

                <h2 class="mt-4">Course Objectives</h2>
                <ul>
                    @if($course->objectives)
                        @foreach(explode("\n", $course->objectives) as $objective)
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>{{ $objective }}</span>
                            </li>
                        @endforeach
                    @else
                        <li><i class="fas fa-check-circle"></i> Gain comprehensive knowledge in {{ $course->course_name }}.</li>
                        <li><i class="fas fa-check-circle"></i> Apply practical skills related to this subject in real-world scenarios.</li>
                        <li><i class="fas fa-check-circle"></i> Master essential concepts and techniques covered in this course.</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
