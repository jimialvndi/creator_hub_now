<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Talent;

class TalentSeeder extends Seeder
{
    public function run(): void
    {
        $talents = [
            [
                'name' => 'Alya Putri',
                'role' => 'Beauty Content Creator',
                'bio' => 'Mahasiswi farmasi yang hobi review skincare dan makeup lokal.',
                'niche' => 'Beauty',
                'skills' => ['Makeup Tutorial', 'Skincare Review', 'Video Editing'],
                'interests' => ['Beauty', 'Fashion', 'Lifestyle'],
                'followers_count' => 15400,
                'rate_min' => 250000,
                'rate_max' => 750000,
                'instagram' => 'alyaputri.beauty',
                'tiktok' => 'alyabeauty',
                'is_featured' => true,
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Tech Reviewer',
                'bio' => 'Anak IT yang suka bongkar gadget dan coding tipis-tipis.',
                'niche' => 'Technology',
                'skills' => ['Gadget Review', 'Coding', 'Unboxing'],
                'interests' => ['Technology', 'Gaming', 'Gadgets'],
                'followers_count' => 8500,
                'rate_min' => 150000,
                'rate_max' => 400000,
                'instagram' => 'buditech',
                'tiktok' => 'budigadget',
                'is_featured' => false,
            ],
            [
                'name' => 'Citra Lestari',
                'role' => 'Food Vlogger',
                'bio' => 'Keliling Pontianak cari makanan enak dan murah meriah.',
                'niche' => 'F&B',
                'skills' => ['Food Review', 'Mukbang', 'Photography'],
                'interests' => ['Food', 'Culinary', 'Travel'],
                'followers_count' => 22100,
                'rate_min' => 300000,
                'rate_max' => 900000,
                'instagram' => 'citra.makan',
                'tiktok' => 'citra.kuliner',
                'is_featured' => true,
            ],
            [
                'name' => 'Dimas Anggara',
                'role' => 'Education Creator',
                'bio' => 'Sharing tips skripsi, beasiswa, dan produktivitas mahasiswa.',
                'niche' => 'Education',
                'skills' => ['Public Speaking', 'Teaching', 'Writing'],
                'interests' => ['Education', 'Productivity', 'Books'],
                'followers_count' => 45000,
                'rate_min' => 500000,
                'rate_max' => 1500000,
                'instagram' => 'dimas.edu',
                'tiktok' => 'dimasbelajar',
                'is_featured' => true,
            ],
            [
                'name' => 'Eka Wijaya',
                'role' => 'Sport Enthusiast',
                'bio' => 'Ayo hidup sehat! Sharing workout rutin dan tips diet.',
                'niche' => 'Lifestyle',
                'skills' => ['Workout', 'Diet Tips', 'Vlogging'],
                'interests' => ['Health', 'Sports', 'Lifestyle'],
                'followers_count' => 12000,
                'rate_min' => 200000,
                'rate_max' => 600000,
                'instagram' => 'eka.fit',
                'tiktok' => 'ekaworkout',
                'is_featured' => false,
            ],
        ];

        foreach ($talents as $talent) {
            Talent::create($talent);
        }
    }
}