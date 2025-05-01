<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoProgress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'video_id',
        'current_time',
        'completed',
        'last_watched_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'current_time' => 'float',
        'completed' => 'boolean',
        'last_watched_at' => 'datetime',
    ];

    /**
     * Get the user who watched the video.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the video being watched.
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
