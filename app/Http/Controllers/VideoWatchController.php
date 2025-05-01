<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Video;
use App\Models\VideoProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoWatchController extends Controller
{
    /**
     * Display a video for watching with simplified interface
     *
     * @param int $course_id
     * @param int $video_id
     * @return \Illuminate\View\View
     */
    public function watch($course_id, $video_id)
    {
        // Get the course and video
        $course = Course::findOrFail($course_id);
        $video = Video::findOrFail($video_id);

        // Check file exists
        $videoPath = $video->file_path;
        $fileExists = Storage::disk('public')->exists($videoPath);

        // If file doesn't exist in public storage, check if it's a direct path
        if (!$fileExists && !file_exists(public_path($videoPath))) {
            return view('student.simple-watch', [
                'course' => $course,
                'video' => $video,
                'error' => 'Video file not found: ' . $videoPath
            ]);
        }

        return view('student.watch', [
            'course' => $course,
            'video' => $video
        ]);
    }

    /**
     * Mark a video as complete
     *
     * @param int $video_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markComplete($video_id)
    {
        VideoProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'video_id' => $video_id
            ],
            [
                'completed' => true,
                'last_watched_at' => now()
            ]
        );

        return redirect()->back()->with('success', 'Video marked as complete!');
    }
}
