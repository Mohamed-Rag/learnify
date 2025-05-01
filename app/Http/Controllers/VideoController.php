<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\VideoProgress;

class VideoController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        // Apply auth middleware to all methods
        $this->middleware('auth');

        // Apply teacher middleware only to specific methods
        $this->middleware(\App\Http\Middleware\CheckRole::class.':teacher', [
            'except' => ['watch', 'updateProgress']
        ]);
    }

    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('videos.create', compact('course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'course_id' => 'required|exists:courses,id',
            'video_file' => 'required|file|mimes:mp4,mov,avi,wmv|max:102400', // 100MB max
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB max
            'description' => 'nullable|string'
        ]);

        // Store the video file
        $videoPath = $request->file('video_file')->store('videos', 'public');

        // Store thumbnail if provided
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Create video record
        $video = Video::create([
            'title' => $request->title,
            'course_id' => $request->course_id,
            'file_path' => $videoPath,
            'thumbnail_path' => $thumbnailPath,
            'description' => $request->description
        ]);

        // FIX: Return to the course display page with the correct course ID
        return redirect()->route('view.course', $request->course_id)
            ->with('success', 'Video uploaded successfully');
    }

    /**
     * Display the specified course with its videos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $course = Course::with('videos', 'category')->findOrFail($id);

        // Check if the logged-in user is the owner of the course
        if (auth()->id() !== $course->user_id) {
            return redirect()->route('teacher.managecourses')
                ->with('error', 'You are not authorized to view this course\'s videos.');
        }

        return view('videos.show', compact('course'));
    }

    /**
     * Update the specified video in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $course = Course::findOrFail($video->course_id);

        // Check if the logged-in user is the owner of the course
        if (auth()->id() !== $course->user_id) {
            return redirect()->route('teacher.managecourses')
                ->with('error', 'You are not authorized to update this video.');
        }

        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $video->title = $request->title;
        $video->description = $request->description;

        // Handle thumbnail upload if provided
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($video->thumbnail_path && Storage::disk('public')->exists($video->thumbnail_path)) {
                Storage::disk('public')->delete($video->thumbnail_path);
            }

            // Store new thumbnail
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $video->thumbnail_path = $thumbnailPath;
        }

        $video->save();

        // FIX: Return to the course display page with the correct course ID
        return redirect()->route('view.course', $course->id)
            ->with('success', 'Video updated successfully!');
    }

    /**
     * Remove the specified video from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $course = Course::findOrFail($video->course_id);

        // Check if the logged-in user is the owner of the course
        if (auth()->id() !== $course->user_id) {
            return redirect()->route('teacher.managecourses')
                ->with('error', 'You are not authorized to delete this video.');
        }

        // Delete video file if exists
        if ($video->file_path && Storage::disk('public')->exists($video->file_path)) {
            Storage::disk('public')->delete($video->file_path);
        }

        // Delete thumbnail if exists
        if ($video->thumbnail_path && Storage::disk('public')->exists($video->thumbnail_path)) {
            Storage::disk('public')->delete($video->thumbnail_path);
        }

        $video->delete();

        // FIX: Return to the course display page with the correct course ID
        return redirect()->route('view.course', $course->id)
            ->with('success', 'Video deleted successfully!');
    }





/**
 * Watch a video and track progress
 *
 * @param int $course_id
 * @param int $video_id
 * @return \Illuminate\Http\Response
 */
public function watch($course_id, $video_id)
{

    \Log::debug('Watch method accessed', [
        'course_id' => $course_id,
        'video_id' => $video_id,
        'user_id' => auth()->id()
    ]);


    $video = Video::with('course')->findOrFail($video_id);
    $course = Course::findOrFail($course_id);

    // Check if user is enrolled in this course
    $enrollment = Enrollment::where('user_id', Auth::id())
        ->where('course_id', $course->id)
        ->first();

        if (!$enrollment) {
            return redirect()->route('student.dashboard')
                ->with('error', 'You must enroll in this course to watch videos.');
        }

        if ($video->course_id != $course_id) {
            return redirect()->route('student.dashboard')
                ->with('error', 'This video does not belong to the specified course.');
        }

        // Get video progress for current user
        $progress = VideoProgress::where('user_id', Auth::id())
            ->where('video_id', $video_id)
            ->first();

        // Get next and previous videos
        $nextVideo = Video::where('course_id', $course_id)
            ->where('id', '>', $video_id)
            ->orderBy('id', 'asc')
            ->first();

        $prevVideo = Video::where('course_id', $course_id)
            ->where('id', '<', $video_id)
            ->orderBy('id', 'desc')
            ->first();

        // Calculate course progress
        $courseVideos = Video::where('course_id', $course_id)
            ->orderBy('id', 'asc')
            ->get();

        $totalVideos = $courseVideos->count();
        $completedVideos = VideoProgress::where('user_id', Auth::id())
            ->whereIn('video_id', $courseVideos->pluck('id'))
            ->where('completed', true)
            ->count();

        $courseProgress = $totalVideos > 0 ? ($completedVideos / $totalVideos) * 100 : 0;

    return view('student.watch_video', compact(
        'video',
        'course',
        'courseVideos',
        'progress',
        'nextVideo',
        'prevVideo',
        'completedVideos',
        'totalVideos',
        'courseProgress'
    ));
}

    /**
     * Update video progress via AJAX
     */
    public function updateProgress(Request $request, $course_id, $video_id)
{
    \Log::debug('Update progress accessed', [
        'course_id' => $course_id,
        'video_id' => $video_id,
        'user_id' => auth()->id(),
        'current_time' => $request->current_time,
        'completed' => $request->completed
    ]);

    $validated = $request->validate([
        'current_time' => 'required|numeric',
        'completed' => 'required|boolean',
    ]);

    $video = Video::findOrFail($video_id);

    // Check if user is enrolled
    $isEnrolled = Enrollment::where('user_id', Auth::id())
        ->where('course_id', $video->course_id)
        ->exists();

    if (!$isEnrolled) {
        return response()->json(['error' => 'Not enrolled in this course'], 403);
    }

    // Update or create progress record
    $progress = VideoProgress::updateOrCreate(
        [
            'user_id' => Auth::id(),
            'video_id' => $video_id,
        ],
        [
            'current_time' => $validated['current_time'],
            'completed' => $validated['completed'],
            'last_watched_at' => now(),
        ]
    );

    return response()->json([
        'success' => true,
        'progress' => $progress,
    ]);
}
}
