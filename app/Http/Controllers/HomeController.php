<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use Illuminate\Http\Request;
use App\Models\Course;

class HomeController extends Controller
{
/*************  ✨ Windsurf Command ⭐  *************/
/**
 * Show the home page
 *
 * @return \Illuminate\Http\Response
 */
    public function index()
    {
        $talents = Talent::latest()->take(6)->get();

        // 3. Ambil data kursus terbaru (misal: 3 kursus)
        // withCount('lessons') digunakan untuk menghitung jumlah materi secara otomatis
        $featuredCourses = Course::withCount('lessons')->latest()->take(3)->get();

        // 4. Kirim variabel $featuredCourses ke view
        return view('home', compact('talents', 'featuredCourses'));
    }

    public function about()
    {
        return view('about');
    }

    
}
