<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->title }} - Learnify</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/nav_bar_before.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home-before.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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

/* Color palette refinement */
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
    /* color: #9E1B32; */
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

.card {
    background: var(--card-gradient);
    color: var(--text-primary);
    border: none;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

.btn-primary {
    background-color: var(--primary);
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.btn-primary:hover {
    background-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
}

/* For smaller screens */
@media (max-width: 992px) {
    .video-container {
        grid-template-columns: 1fr;
    }
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
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </div>



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>{{ $video->title }}</h4>
                            <a href="{{ route('student.course.details', $course->id) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Course
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Basic Video Player -->
                        <div style="margin-bottom: 20px;">
                            <video width="100%"  height="650px" controls>
                                <source src="{{ asset('storage/'.$video->file_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>

                        <!-- Simple Complete Button -->
                        <div class="text-center mb-4">
                            <form action="{{ route('student.video.complete', ['video_id' => $video->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    Mark as Complete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
