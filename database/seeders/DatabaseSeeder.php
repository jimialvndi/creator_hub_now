<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Talent;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@untancreatorhub.com',
            'password' => bcrypt('password'),
        ]);

        // Create sample talents
        Talent::create([
            'name' => 'Siti Nurhaliza',
            'photo' => null,
            'role' => 'Content Creator',
            'tagline' => 'Inspiring through educational content',
            'bio' => 'Passionate about creating engaging educational content that makes learning fun. Specializing in science and tech topics for Indonesian students.',
            'niche' => 'Education',
            'interests' => json_encode(['Science', 'Technology', 'Teaching']),
            'skills' => json_encode(['Video Editing', 'Public Speaking', 'Copywriting']),
            'experience' => 'Creator for 2+ years | 100K+ followers | Collaborated with 10+ brands',
            'portfolio' => json_encode([
                'Educational series on Physics',
                'Tech review videos',
                'Study tips content'
            ]),
            'achievements' => 'Winner of National Education Creator Award 2024',
            'instagram' => 'https://instagram.com/sitinurhaliza',
            'tiktok' => 'https://tiktok.com/@sitinurhaliza',
            'youtube' => 'https://youtube.com/@sitinurhaliza',
            'email' => 'siti@example.com',
            'is_featured' => true,
        ]);

        Talent::create([
            'name' => 'Ahmad Rifai',
            'photo' => null,
            'role' => 'Videographer',
            'tagline' => 'Capturing stories through cinematic visuals',
            'bio' => 'Professional videographer with expertise in documentary and commercial projects. Love telling stories that matter.',
            'niche' => 'Videography',
            'interests' => json_encode(['Documentary', 'Cinematography', 'Storytelling']),
            'skills' => json_encode(['Video Production', 'Color Grading', 'Motion Graphics']),
            'experience' => 'Worked on 50+ projects | 3 years experience | University event coverage specialist',
            'portfolio' => json_encode([
                'UNTAN Documentary Series',
                'Campus event highlights',
                'Brand commercials'
            ]),
            'achievements' => 'Best Cinematography - Campus Film Festival 2024',
            'instagram' => 'https://instagram.com/ahmadrifai',
            'youtube' => 'https://youtube.com/@ahmadrifai',
            'email' => 'ahmad@example.com',
            'is_featured' => true,
        ]);

        Talent::create([
            'name' => 'Dewi Lestari',
            'photo' => null,
            'role' => 'Lifestyle Influencer',
            'tagline' => 'Living authentically, inspiring daily',
            'bio' => 'Lifestyle content creator focusing on sustainable living and self-development for young adults.',
            'niche' => 'Lifestyle',
            'interests' => json_encode(['Sustainability', 'Self-Care', 'Fashion']),
            'skills' => json_encode(['Photography', 'Content Planning', 'Brand Collaboration']),
            'experience' => 'Active creator since 2022 | 50K+ Instagram followers | Brand ambassador for 5 local brands',
            'portfolio' => json_encode([
                'Sustainable lifestyle tips',
                'Daily vlog series',
                'Fashion lookbooks'
            ]),
            'achievements' => 'Featured in National Lifestyle Magazine 2024',
            'instagram' => 'https://instagram.com/dewilestari',
            'tiktok' => 'https://tiktok.com/@dewilestari',
            'email' => 'dewi@example.com',
            'is_featured' => false,
        ]);
    }
}
