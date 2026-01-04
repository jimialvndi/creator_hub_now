<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminCourseController extends Controller
{
    // === BAGIAN MANAGE COURSE (INDUK) ===

    public function index()
    {
        $courses = Course::withCount('lessons')->latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|image|max:2048', // Max 2MB
            'description' => 'required|string',
            'access_level' => 'required|in:free,member,pro_member',
        ]);

        $data = $request->all();
        
        // Buat slug otomatis dari title
        $data['slug'] = Str::slug($request->title);

        // Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        Course::create($data);

        return redirect()->route('admin.courses.index')->with('success', 'Kelas baru berhasil dibuat! Silakan tambah materi video.');
    }

    public function edit(Course $course)
    {
        // Load lessons agar bisa ditampilkan di halaman edit
        $course->load('lessons');
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'access_level' => 'required|in:free,member,pro_member',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama jika ada
            if ($course->thumbnail) Storage::disk('public')->delete($course->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        $course->update($data);

        return redirect()->route('admin.courses.edit', $course->id)->with('success', 'Informasi kelas berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        if ($course->thumbnail) Storage::disk('public')->delete($course->thumbnail);
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Kelas berhasil dihapus.');
    }

    // === BAGIAN MANAGE LESSONS (ANAK/SUB-MATERI) ===
    // Kita siapkan function-nya sekarang, view-nya di Langkah 3

    public function storeLesson(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url',
            'duration' => 'required|string|max:50', // e.g. "10:05"
        ]);

        $course->lessons()->create([
            'title' => $request->title,
            'youtube_url' => $request->youtube_url,
            'duration' => $request->duration,
            'sort_order' => $course->lessons()->count() + 1,
        ]);

        return back()->with('success', 'Materi video berhasil ditambahkan!');
    }

    public function destroyLesson(CourseLesson $courseLesson)
    {
        $courseLesson->delete();
        return back()->with('success', 'Materi video dihapus.');
    }
}