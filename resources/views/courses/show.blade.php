<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Course Videos - Learnify</title>
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
            padding: 0 20px;
        }

        .card {
            background-color: #1a1a1a;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #860000;
            color: white;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
        }

        .nav-link {
            color: #ccc;
            border-radius: 4px;
            margin-bottom: 5px;
        }

        .nav-link:hover, .nav-link.active {
            background-color: #860000;
            color: white;
        }

        .video-card {
            background-color: rgba(26, 26, 26, 0.95);
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 2px solid #860000;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(134, 0, 0, 0.3);
        }

        .video-thumbnail {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            background-color: #1a1a1a;
        }

        .video-thumbnail img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 48px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .video-card:hover .play-icon {
            opacity: 1;
        }

        .video-info {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .video-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            color: white;
        }

        .video-description {
            color: #ccc;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 20px;
            flex-grow: 1;
        }

        .video-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: auto;
        }

        .video-actions .btn {
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .video-actions .btn i {
            font-size: 16px;
        }

        .btn-primary, .btn-success {
            background-color: #860000;
            border-color: #860000;
        }

        .btn-primary:hover, .btn-success:hover {
            background-color: #6b0000;
            border-color: #6b0000;
        }

        .btn-outline-primary {
            border-color: #860000;
            color: #860000;
        }

        .btn-outline-primary:hover {
            background-color: #860000;
            color: white;
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }

        .btn-close {
            color: #ffffff;
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

        .modal-content {
            background-color: #1a1a1a;
            color: white;
        }

        .modal-header {
            border-bottom: 1px solid #333;
        }

        .modal-footer {
            border-top: 1px solid #333;
        }

        .form-control {
            background-color: #2d2d2d;
            border: 1px solid #444;
            color: white;
        }


        .form-control:focus {
            background-color: #2d2d2d;
            border-color: #860000;
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(134, 0, 0, 0.25);
        }

        .form-control::placeholder {
            color: #777;
        }

        .alert {
            border-radius: 10px;
            background-color: #33333300;
            color: #ffffff;
            border: 1px solid #444;
        }

        .course-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .course-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .course-info h3 {
            margin: 0;
            font-size: 24px;
            color: #ffffff;
        }

        .course-info p {
            color: #ffffff;
            margin: 5px 0 0;
        }
        .text-white {
            color: #ffffff;
        }

        .video-player {
            margin-bottom: 30px;
        }

        .video-player video {
            width: 100%;
            border-radius: 8px;
        }

        .row {
            margin: -12px;
        }

        .col-md-6 {
            padding: 12px;
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
            <div class="col-md-12"> <!-- Changed from col-md-10 to col-md-12 -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Manage Course Videos</h4>
                        <div>
                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#uploadVideoModal">
                                <i class="fas fa-plus"></i> Upload New Video
                            </button>
                            <a href="{{ route('edit.course', ['id' => $course->id]) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Course Details
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
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

                                <div class="course-header">
                                    <img src="{{ asset($course->image) }}" alt="{{ $course->course_name }}" class="course-image">
                                    <div class="course-info">
                                        <h3>{{ $course->course_name }}</h3>
                                        <p>  {{ $course->category->category_name }}</p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="text-white">Course Videos</h5>
                                </div>

                                @if($course->videos->count() > 0)
                                    <div class="row">
                                        @foreach($course->videos as $video)
                                            <div class="col-md-6 mb-4">
                                                <div class="video-card">
                                                    <div class="video-thumbnail">
                                                        <img src="{{ $video->thumbnail_path ? asset('storage/' . $video->thumbnail_path) : asset('images/video-placeholder.jpg') }}" alt="{{ $video->title }}">
                                                        <div class="play-icon">
                                                            <i class="fas fa-play-circle"></i>
                                                        </div>
                                                    </div>
                                                    <div class="video-info">
                                                        <h5 class="video-title">{{ $video->title }}</h5>
                                                        <p class="video-description">{{ \Illuminate\Support\Str::limit($video->description, 60) }}</p>
                                                        <div class="video-actions">
                                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#playVideoModal{{ $video->id }}">
                                                                <i class="fas fa-play"></i> Play
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editVideoModal{{ $video->id }}">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteVideoModal{{ $video->id }}">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Play Video Modal -->
                                                <div class="modal fade" id="playVideoModal{{ $video->id }}" tabindex="-1" aria-labelledby="playVideoModalLabel{{ $video->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="playVideoModalLabel{{ $video->id }}">{{ $video->title }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="video-player">
                                                                    <video controls width="100%">
                                                                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                                                        Your browser does not support the video tag.
                                                                    </video>
                                                                </div>
                                                                <h5>{{ $video->title }}</h5>
                                                                <p>{{ $video->description }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Edit Video Modal -->
                                                <div class="modal fade" id="editVideoModal{{ $video->id }}" tabindex="-1" aria-labelledby="editVideoModalLabel{{ $video->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editVideoModalLabel{{ $video->id }}">Edit Video</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="title" class="form-label">Video Title</label>
                                                                        <input type="text" class="form-control" id="title" name="title" value="{{ $video->title }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="description" class="form-label">Description</label>
                                                                        <textarea class="form-control" id="description" name="description" rows="3">{{ $video->description }}</textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="thumbnail" class="form-label">Thumbnail (Optional)</label>
                                                                        <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                                                                        @if($video->thumbnail_path)
                                                                            <div class="mt-2">
                                                                                <img src="{{ asset('storage/' . $video->thumbnail_path) }}" alt="Current Thumbnail" class="img-thumbnail" style="max-height: 100px;">
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Delete Video Modal -->
                                                <div class="modal fade" id="deleteVideoModal{{ $video->id }}" tabindex="-1" aria-labelledby="deleteVideoModalLabel{{ $video->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteVideoModalLabel{{ $video->id }}">Confirm Delete</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete the video "<strong>{{ $video->title }}</strong>"?</p>
                                                                <p class="text-danger">This action cannot be undone!</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Delete Video</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <p>No videos have been uploaded for this course yet.</p>
                                    </div>
                                @endif

                                <!-- Upload Video Modal -->
                                <div class="modal fade" id="uploadVideoModal" tabindex="-1" aria-labelledby="uploadVideoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="uploadVideoModalLabel">Upload New Video</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Video Title</label>
                                                        <input type="text" class="form-control" id="title" name="title" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Description (Optional)</label>
                                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="video_file" class="form-label">Video File</label>
                                                        <input type="file" class="form-control" id="video_file" name="video_file" accept="video/*" required>
                                                        <small class="form-text text-muted">Max file size: 100MB. Supported formats: MP4, MOV, AVI, WMV</small>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="thumbnail" class="form-label">Thumbnail (Optional)</label>
                                                        <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                                                        <small class="form-text text-muted">Max file size: 2MB. Recommended size: 1280x720px</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Upload Video</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
