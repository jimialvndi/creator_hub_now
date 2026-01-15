<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Panggil seeder Talent
        $this->call([
            TalentSeeder::class,
        ]);
        
        // 2. Buat Admin (Gunakan firstOrCreate agar tidak error duplikat)
        // Logikanya: Cari user dengan email ini. Jika TIDAK ADA, baru buat.
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Kunci pencarian
            [
                'name' => 'Admin Creator Hub',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}