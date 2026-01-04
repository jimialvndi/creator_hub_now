<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'access_level',
    ];

    // Relasi: Satu Course punya banyak Lesson
    public function lessons()
    {
        return $this->hasMany(CourseLesson::class)->orderBy('sort_order', 'asc');
    }
}