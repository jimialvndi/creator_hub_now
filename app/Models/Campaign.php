<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name', 'brand_email', 'brand_whatsapp',
        'campaign_name', 'budget', 'platform', 'niche', 
        'deadline', 'brief', 'agreement_replacement', 'status'
    ];

    public function talents()
    {
        return $this->belongsToMany(Talent::class, 'campaign_talent')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}