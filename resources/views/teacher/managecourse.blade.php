<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Courses</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

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

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        .card {
            background-color: rgba(26, 26, 26, 0.232);
            border-radius: 15px;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 13px 13px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .card h5 {
            color: white;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .card p {
            color: #ccc;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .card-actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .card-actions a {
            flex: 1;
            text-align: center;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #860000;
            border: none;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #a00000;
        }

        .btn-outline-primary, .btn-outline-info, .btn-outline-danger {
            border-radius: 20px;
            font-size: 14px;
        }

        .btn-outline-primary {
            color: #fff;
            border: 1px solid #860000;
        }

        .btn-outline-info {
            color: #fff;
            border: 1px solid #004d99;
        }

        .btn-outline-danger {
            color: #fff;
            border: 1px solid #dc3545;
        }

        .btn-outline-primary:hover {
            background-color: #860000;
        }

        .btn-outline-info:hover {
            background-color: #004d99;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
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
            <a href="{{ route('teacher.dashboard') }}">Home</a>
            <a href="{{ route('teacher.profile') }}">Profile</a>
            <a href="{{ route('teacher.managecourses') }}" class="active">Manage Courses</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manage Courses</h2>
            <a href="{{ route('teacher.create.course') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New Course
            </a>
        </div>

        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ asset($course->image) }}" class="card-img-top" alt="{{ $course->title }}">
                        <div class="card-body">
                            <h5>{{ $course->course_name }}</h5>
                            <p>{{ Str::limit($course->description, 100) }}</p>
                            <div class="card-actions">
                                <a href="{{ route('edit.course', ['id' => $course->id]) }}" class="btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('view.course', ['id' => $course->id]) }}" class="btn-outline-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('delete.course', ['id' => $course->id]) }}" class="btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
