<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'course_id',
        'file_path',
        'thumbnail_path',
        'description',
        'duration'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
