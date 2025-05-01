<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course - Learnify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">
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

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 40px 20px;
        }

        .card {
            background-color: #1a1a1a;
            border-radius: 10px;
        }

        .card-header {
            background-color: #860000;
            color: white;
            font-weight: bold;
            border-radius: 8px 8px 0 0 !important;
            padding: 15px 20px;
        }

        .card-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 500;
            color: white;
        }
        .form-control, .form-select {
            background-color: #2d2d2d;
            border: 1px solid #444;
            color: white;
            padding: 12px 15px;
            border-radius: 8px;
        }

        .form-control:focus, .form-select:focus {
            background-color: #333;
            color: white;
            border-color: #860000;
            box-shadow: 0 0 0 0.25rem rgba(134, 0, 0, 0.25);
        }

        .form-control::placeholder {
            color: #888;
        }

        .form-select option {
            background-color: #2d2d2d;
            color: white;
        }

        .btn-primary {
            background-color: #860000;
            border-color: #860000;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #a00000;
            border-color: #a00000;
        }

        .btn-secondary {
            background-color: #333;
            border-color: #333;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-secondary:hover {
            background-color: #444;
            border-color: #444;
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

        label {
            margin-bottom: 8px;
            font-weight: 500;
        }

        .mb-3:last-child {
            margin-bottom: 0;
        }

        .form-text {
            color: #888;
        }

        .current-image {
            margin-top: 10px;
            border-radius: 8px;
            max-width: 100%;
            height: auto;
            max-height: 200px;
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Course</h4>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('update.course', $course->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="course_name" class="form-label">Course Name</label>
                                <input type="text" class="form-control" id="course_name" name="course_name" value="{{ old('course_name', $course->course_name) }}" required placeholder="Enter course name">
                                <div class="form-text">Choose a concise and descriptive name (max 50 characters)</div>
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="" disabled>Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Course Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter course description">{{ old('description', $course->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="course_image" class="form-label">Course Image</label>
                                @if($course->image)
                                    <div class="mb-2">
                                        <img src="{{ asset($course->image) }}" alt="Current course image" class="current-image d-block">
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="course_image" name="course_image">
                                <div class="form-text">Leave empty to keep the current image. Recommended size: 1280x720px (16:9 ratio)</div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('teacher.managecourses') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Course</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
