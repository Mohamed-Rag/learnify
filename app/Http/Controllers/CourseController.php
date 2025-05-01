<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Constructor to apply middleware
     */







    public function __construct()
    {
        // Apply auth middleware to all methods
        $this->middleware('auth');

        // Only teachers can access these methods
        $this->middleware(\App\Http\Middleware\CheckRole::class.':teacher')->only(['create', 'store', 'edit', 'update', 'destroy', 'teacherCourses', 'manageCourses']);
    }

    /**
     * Display a listing of all available courses.
     *
     * @return \Illuminate\Http\Response
     */


    public function index($category_id)
{
    $courses = Course::where('category_id', $category_id)->get();
    return view('student.courses', compact('courses'));
}

    /**
     * Display courses created by the logged-in teacher.
     *
     * @return \Illuminate\Http\Response
     */
    public function teacherCourses()
    {
        $courses = Course::where('user_id', Auth::id())->latest()->get();
        return view('teacher.courses', compact('courses'));
    }

    /**
     * Manage courses created by the logged-in teacher.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageCourses()
    {
        $courses = Course::where('user_id', Auth::id())->latest()->get();
        return view('teacher.managecourse', compact('courses'));
    }

    /**
     * Show the form for creating a new course (teachers only).
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('courses.create', compact('categories'));
    }

    /**
     * Store a newly created course (teachers only).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $course = new Course([
            'course_name' => $request->course_name,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        // Handle image upload if provided
        if ($request->hasFile('course_image')) {
            $image = $request->file('course_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/courses'), $imageName);
            $course->image = 'images/courses/' . $imageName;
        }

        $course->save();

        return redirect()->route('teacher.managecourses')->with('success', 'Course created successfully!');
    }

    /**
     * Display a specific course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::with(['user', 'category', 'videos'])->findOrFail($id);

        $user = Auth::user();
        $isOwner = $course->user_id === $user->id;

        return view('courses.show', compact('course', 'isOwner'));
    }

    /**
     * Show the form for editing a course (teachers only).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the course
        $course = Course::findOrFail($id);

        // Check if the logged-in teacher owns this course
        if (Auth::id() !== $course->user_id) {
            return redirect()->route('teacher.managecourses')
                ->with('error', 'You are not authorized to edit this course.');
        }

        // Get all categories
        $categories = Category::all();

        return view('courses.edit', compact('course', 'categories'));
    }

    /**
     * Update a course (teachers only).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the course
        $course = Course::findOrFail($id);

        // Check if the logged-in teacher owns this course
        if (Auth::id() !== $course->user_id) {
            return redirect()->route('teacher.managecourses')
                ->with('error', 'You are not authorized to update this course.');
        }

        // Validate the request
        $request->validate([
            'course_name' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update the course
        $course->course_name = $request->course_name;
        $course->category_id = $request->category_id;
        $course->description = $request->description;

        // Handle image upload if provided
        if ($request->hasFile('course_image')) {
            // Delete old image if exists
            if ($course->image && file_exists(public_path($course->image))) {
                unlink(public_path($course->image));
            }

            // Store new image
            $image = $request->file('course_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/courses'), $imageName);
            $course->image = 'images/courses/' . $imageName;
        }

        $course->save();

        return redirect()->route('teacher.managecourses')
            ->with('success', 'Course updated successfully.');
    }



    /**
     * Display teacher profile with their courses.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $courses = Course::where('user_id', Auth::id())->latest()->get();
        return view('teacher.profile', compact('courses'));
    }

    /**
     * Delete a course (teachers only).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        // Check if the user is the owner of the course
        if ($course->user_id !== Auth::id()) {
            return redirect()->route('teacher.managecourses')->with('error', 'You are not authorized to delete this course.');
        }

        $course->delete();

        return redirect()->route('teacher.managecourses')->with('success', 'Course deleted successfully!');
    }

    /**
     * Browse courses by category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function coursesByCategory(Category $category)
    {
        $courses = $category->courses()->with('user')->latest()->get();
        return view('courses.by_category', compact('courses', 'category'));
    }

    /**
     * Search for courses.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $courses = Course::where('course_name', 'like', "%{$keyword}%")
            ->with(['user', 'category'])
            ->latest()
            ->get();

        return view('courses.search_results', compact('courses', 'keyword'));
    }



    // Add this method after the index() method
/**
 * Display course details for students.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function courseDetails($id)
{
    $course = Course::with(['user', 'videos'])->findOrFail($id);
    $videos = $course->videos;

    return view('student.course_details', compact('course', 'videos'));
}
}
