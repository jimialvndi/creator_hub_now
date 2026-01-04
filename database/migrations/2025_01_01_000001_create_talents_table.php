<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('role');
            // Tagline dihapus sesuai request "Hanya ada..."
            $table->text('bio'); // Deskripsi
            $table->string('niche');
            $table->json('interests')->nullable();
            $table->json('skills');
            $table->integer('followers_count')->default(0); // Field baru
            $table->text('experience')->nullable();

            // Portfolio akan menyimpan JSON array of objects: 
            // [{title: "...", link: "...", thumbnail: "..."}]
            $table->json('portfolio')->nullable();

            $table->text('achievements')->nullable();

            // Social Media
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('email')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talents');
    }
};
