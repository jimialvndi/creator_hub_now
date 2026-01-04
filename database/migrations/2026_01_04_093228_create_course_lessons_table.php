<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_lessons', function (Blueprint $table) {
            $table->id();
            // Hubungkan ke table courses
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            
            $table->string('title');
            $table->string('youtube_url'); // Link video
            $table->string('duration'); // e.g. "10 menit"
            $table->integer('sort_order')->default(0); // Untuk urutan materi
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_lessons');
    }
};