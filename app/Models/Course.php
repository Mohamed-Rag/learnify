<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_name',
        'user_id',
        'category_id',
    ];

    /**
     * Get the user (instructor) who created the course.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that the course belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the videos for the course.
     */
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    /**
     * Get the enrollments for the course.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get the certificates issued for the course.
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * Get the comments for the course.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the users enrolled in this course.
     */
    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }
}
