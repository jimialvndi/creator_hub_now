<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'youtube_url',
        'duration',
        'sort_order',
    ];

    // Relasi kebalikannya (opsional tapi bagus ada)
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}