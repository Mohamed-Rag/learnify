<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'enrollment_date',
        'user_id',
        'course_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'enrollment_date' => 'datetime',
    ];

    /**
     * Get the user who enrolled.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course the user enrolled in.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
