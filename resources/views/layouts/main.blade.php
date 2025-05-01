<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Learnify') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="website icon" type="png" href="{{ asset('public/images/Logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/nav_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Home.css') }}">
    @yield('styles')
</head>
<body>

    <div class="navbar">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('public/images/Logo.png') }}" alt="Logo">
            <span>Learnify</span>
        </a>

        <div class="menu">
            <a href="{{ url('courses') }}">Courses</a>
            <a href="{{ url('instructors') }}">Instructors</a>
            <a href="{{ url('subscribe') }}" style="text-decoration: none;">
                <button class="subscribe-btn">Subscribe</button>
            </a>
        </div>

        <div class="right-section">
            <div class="search-container">
                <input class="search" type="text" placeholder="search courses, topics instructors...">
            </div>
            <div class="nav-icons">
                <a href="{{ url('my-courses') }}" class="nav-icon"><i class="fa-solid fa-bookmark"></i></a>

                <div class="dropdown">
                    <span class="nav-icon" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                    </span>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">New course available</a></li>
                        <li><a class="dropdown-item" href="#">Assignment due soon</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">View all notifications</a></li>
                    </ul>
                </div>

                <div class="dropdown">
                    <span class="nav-icon" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ url('profile') }}">Profile</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @yield('content')

    <div class="support">
        <a href="{{ url('support') }}">
            <button>
                <i class="fas fa-question-circle"></i>
                <span>Support</span>
            </button>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
