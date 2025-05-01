<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video - Learnify</title>
    <!-- Include your CSS and JS files -->
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Upload Video for {{ $course->course_name }}</h4>
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

                        <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">

                            <div class="mb-3">
                                <label for="title" class="form-label">Video Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="video_file" class="form-label">Video File</label>
                                <input type="file" class="form-control" id="video_file" name="video_file" required>
                                <div class="form-text">Accepted formats: MP4, MOV, AVI, WMV (max 100MB)</div>
                            </div>

                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail Image (Optional)</label>
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                                <div class="form-text">Accepted formats: JPEG, PNG, JPG (max 2MB)</div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Upload Video</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
