<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Untuk URL SEO friendly
            $table->string('thumbnail')->nullable();
            $table->text('description')->nullable();
            
            // Permission: Siapa yang boleh akses?
            // free = semua user login
            // member = member & pro
            // pro_member = khusus pro
            $table->enum('access_level', ['free', 'member', 'pro_member'])->default('free');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};