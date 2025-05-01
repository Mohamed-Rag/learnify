<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideoWatchController;

// Default welcome page - accessible without login
Route::get('/', function () {
    return view('welcome');
  })->name('welcome');
// Authentication routes
Auth::routes();

// Home route redirects to appropriate dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Teacher routes
Route::group(['middleware' => ['auth', \App\Http\Middleware\CheckRole::class.':teacher'], 'prefix' => 'teacher'], function () {
    Route::get('/dashboard', [HomeController::class, 'teacherDashboard'])->name('teacher.dashboard');

    // Profile and other pages
    Route::get('/profile', [CourseController::class, 'profile'])->name('teacher.profile');

    // Course routes
    Route::get('/courses', [CourseController::class, 'teacherCourses'])->name('teacher.courses');
    Route::get('/managecourses', [CourseController::class, 'manageCourses'])->name('teacher.managecourses');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('teacher.create.course');
    Route::post('/courses', [CourseController::class, 'store'])->name('teacher.store.course');
    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('edit.course');
    Route::put('/courses/{id}', [CourseController::class, 'update'])->name('update.course');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('view.course');
    Route::get('/courses/{id}/delete', [CourseController::class, 'destroy'])->name('delete.course');
    Route::get('/courses/{course}/videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
    Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
    Route::get('/courses/{id}/videos', [App\Http\Controllers\VideoController::class, 'view'])->name('videos.view');
    Route::put('/videos/{id}', [App\Http\Controllers\VideoController::class, 'update'])->name('videos.update');
    Route::delete('/videos/{id}', [App\Http\Controllers\VideoController::class, 'destroy'])->name('videos.destroy');
});

// Student routes
Route::group(['middleware' => ['auth', \App\Http\Middleware\CheckRole::class.':student'], 'prefix' => 'student'], function () {
    Route::get('/dashboard', [HomeController::class, 'studentDashboard'])->name('student.dashboard');

    // Keep the general courses route
    Route::get('/courses', function () {
        return view('student.courses');
    })->name('student.all.courses');

    Route::get('/profile', function () {
        return view('student.profile');
    })->name('student.profile');

    Route::get('/categories', function () {
        return view('student.categories');
    })->name('student.categories');

    // Updated route for viewing courses by category
    Route::get('/categories/{category_id}/courses', [CategoryController::class, 'showCourses'])
        ->name('student.courses');

    Route::get('/courses/{id}/details', [CourseController::class, 'courseDetails'])
        ->name('student.course.details');

    // Video watching routes - Updated route pattern to be more consistent
// Simple video watching route for troubleshooting
Route::get('/courses/{course_id}/videos/{video_id}/simple', [App\Http\Controllers\VideoWatchController::class, 'watch'])
    ->name('student.watch.video.simple');

// Mark video as complete
Route::post('/video/{video_id}/complete', [App\Http\Controllers\VideoWatchController::class, 'markComplete'])
    ->name('student.video.complete');
});

// Categories route
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Subscription routes
Route::get('/subscription/plans', [App\Http\Controllers\SubscriptionController::class, 'showPlans'])
    ->name('subscription.plans');
Route::post('/subscription/subscribe', [App\Http\Controllers\SubscriptionController::class, 'subscribe'])
    ->name('subscription.subscribe');
Route::get('/subscription/my-subscriptions', [App\Http\Controllers\SubscriptionController::class, 'mySubscriptions'])
    ->name('subscription.my');

// Payment routes
Route::get('/payment/form/{subscription_id?}', [App\Http\Controllers\PaymentController::class, 'showForm'])
    ->name('payment.form');
Route::post('/payment/process', [App\Http\Controllers\PaymentController::class, 'processPayment'])
    ->name('payment.process');

// Enrollment routes
Route::post('/enrollment/enroll/{course_id}', [App\Http\Controllers\EnrollmentController::class, 'enroll'])
    ->name('enrollment.enroll');
Route::get('/enrollment/my-enrollments', [App\Http\Controllers\EnrollmentController::class, 'myEnrollments'])
    ->name('enrollment.my');
