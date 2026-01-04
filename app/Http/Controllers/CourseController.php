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
    public function learning(Course $course, CourseLesson $lesson = null)
    {
        $user = Auth::user();

        // Pengecekan akses (sama seperti sebelumnya)
        $canAccess = false;
        if ($user->role === 'admin') {
            $canAccess = true;
        } elseif ($course->access_level === 'free') {
            $canAccess = true;
        } elseif ($course->access_level === 'member' && in_array($user->role, ['member', 'pro_member'])) {
            $canAccess = true;
        } elseif ($course->access_level === 'pro_member' && $user->role === 'pro_member') {
            $canAccess = true;
        }

        if (!$canAccess) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Akun Anda tidak memiliki akses ke kelas ini.');
        }

        // Ambil semua materi urut berdasarkan sort_order
        $lessons = $course->lessons()->orderBy('sort_order', 'asc')->get();

        // Tentukan materi saat ini
        $currentLesson = $lesson ?: $lessons->first();

        // Cari index materi saat ini untuk menentukan Prev dan Next
        $currentIndex = $lessons->pluck('id')->search($currentLesson->id);
        $prevLesson = $lessons->get($currentIndex - 1);
        $nextLesson = $lessons->get($currentIndex + 1);

        return view('courses.learning', compact('course', 'lessons', 'currentLesson', 'prevLesson', 'nextLesson'), [
            'hideNav' => true // Menyembunyikan navbar utama
        ]);
    }

    public function myCourses()
    {
        $user = Auth::user(); //

        // Filter kelas berdasarkan role user
        $courses = Course::withCount('lessons')
            ->where(function ($query) use ($user) {
                $query->where('access_level', 'free');

                if (in_array($user->role, ['member', 'pro_member', 'admin'])) {
                    $query->orWhere('access_level', 'member');
                }

                if (in_array($user->role, ['pro_member', 'admin'])) {
                    $query->orWhere('access_level', 'pro_member');
                }
            })
            ->latest()
            ->get();

        return view('courses.my-courses', [
            'courses' => $courses,
            'hideNav' => true // Variabel ini akan menghilangkan nav bar
        ]);
    }
}
