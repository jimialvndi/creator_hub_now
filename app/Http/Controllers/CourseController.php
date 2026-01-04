<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Halaman Daftar Semua Kelas
    public function index()
    {
        $courses = Course::withCount('lessons')->latest()->paginate(9);
        return view('courses.index', compact('courses'));
    }

    // Halaman Detail Kelas (Sebelum Nonton)
    public function show(Course $course)
    {
        // Load lessons urut berdasarkan sort_order
        $course->load(['lessons' => function ($query) {
            $query->orderBy('sort_order', 'asc');
        }]);
        
        return view('courses.show', compact('course'));
    }

    // Halaman Belajar (Nonton Video)
    public function learning(Course $course, $lessonId = null)
    {
        // 1. Cek Permission (Siapa yang boleh akses?)
        $user = Auth::user();
        $canAccess = false;

        if ($user->role === 'admin') {
            $canAccess = true; // Admin bebas akses
        } elseif ($course->access_level === 'free') {
            $canAccess = true; // Kelas gratis, semua user login bisa
        } elseif ($course->access_level === 'member' && in_array($user->role, ['member', 'pro_member'])) {
            $canAccess = true; // Kelas member, bisa diakses Member & Pro
        } elseif ($course->access_level === 'pro_member' && $user->role === 'pro_member') {
            $canAccess = true; // Kelas Pro, hanya Pro
        }

        // Jika tidak punya akses, tendang ke halaman detail dengan pesan error
        if (!$canAccess) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda perlu upgrade akun untuk mengakses kelas ini.');
        }

        // 2. Load Materi
        // Jika lessonId tidak ada (user klik "Mulai Belajar"), ambil materi pertama
        $currentLesson = $lessonId 
            ? $course->lessons()->findOrFail($lessonId) 
            : $course->lessons()->orderBy('sort_order', 'asc')->first();

        // Jika kelas belum ada materinya sama sekali
        if (!$currentLesson) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Materi kelas ini belum tersedia.');
        }

        // Load semua lesson untuk sidebar navigasi
        $lessons = $course->lessons()->orderBy('sort_order', 'asc')->get();

        return view('courses.learning', compact('course', 'lessons', 'currentLesson'));
    }
}