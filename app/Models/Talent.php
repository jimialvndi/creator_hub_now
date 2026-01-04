<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    use HasFactory;
    protected $table = 'talents';
    protected $fillable = [
        'name',
        'photo',
        'role',
        'bio',
        'niche',
        'interests',
        'skills',
        'followers_count', // Tambahkan ini
        'experience',
        'portfolio',
        'achievements',
        'instagram',
        'tiktok',
        'youtube',
        'linkedin',
        'email',
        'is_featured',
    ];

    // Pastikan casts tetap ada
    protected $casts = [
        'interests' => 'array',
        'skills' => 'array',
        'portfolio' => 'array',
        'is_featured' => 'boolean',
    ];

    public function getSkillsArrayAttribute()
    {
        return is_array($this->skills) ? $this->skills : json_decode($this->skills, true) ?? [];
    }

    public function getInterestsArrayAttribute()
    {
        return is_array($this->interests) ? $this->interests : json_decode($this->interests, true) ?? [];
    }

    public function getPortfolioArrayAttribute()
    {
        return is_array($this->portfolio) ? $this->portfolio : json_decode($this->portfolio, true) ?? [];
    }
}
