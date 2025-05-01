<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Enroll in a course
     */
    public function enroll($course_id)
    {
        // Check if user has an active subscription
        $activeSubscription = Subscription::where('user_id', Auth::id())
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->first();

        if (!$activeSubscription) {
            return redirect()->route('subscription.plans')
                ->with('error', 'You need an active subscription to enroll in courses.');
        }

        // Check if course exists
        $course = Course::findOrFail($course_id);

        // Check if already enrolled
        $existingEnrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course_id)
            ->first();



        // Create enrollment
        Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course_id,
            'enrollment_date' => now(),
        ]);

        return redirect()->route('student.course.details', ['id' => $course_id])
            ->with('success', 'You have successfully enrolled in this course!');
    }

    /**
     * Show enrolled courses
     */
    public function myEnrollments()
    {
        $enrollments = Enrollment::with('course')
            ->where('user_id', Auth::id())
            ->get();

        return view('student.my_enrollments', compact('enrollments'));
    }
    public function progress()
{
    $enrollments = Enrollment::with(['course', 'course.videos'])
        ->where('user_id', Auth::id())
        ->get();

    return view('student.progress', compact('enrollments'));
}
}
