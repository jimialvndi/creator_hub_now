<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdmin; // PENTING: Import middleware manual tadi

// Import Controller Creator Hub
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminTalentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. PUBLIC ROUTES
// ==========================================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/talents', [TalentController::class, 'index'])->name('talents.index');
Route::get('/talents/{talent}', [TalentController::class, 'show'])->name('talents.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');


// ==========================================
// 2. USER ROUTES (Wajib Login)
// ==========================================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-courses', [App\Http\Controllers\CourseController::class, 'myCourses'])->name('courses.my');

    // Nonton / Belajar (Materi Pertama)
    Route::get('/courses/{course:slug}/learn', [App\Http\Controllers\CourseController::class, 'learning'])->name('courses.start');
    
    // Nonton / Belajar (Materi Spesifik)
    Route::get('/courses/{course:slug}/learn/{lesson}', [App\Http\Controllers\CourseController::class, 'learning'])->name('courses.learning');
});


// ==========================================
// 3. ADMIN ROUTES (Khusus Role Admin)
// ==========================================

// Perhatikan: Kita memanggil class IsAdmin::class, BUKAN function closure.
Route::middleware(['auth', IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('talents', AdminTalentController::class);
        Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
        Route::patch('/contacts/{contact}/mark-read', [AdminController::class, 'markRead'])->name('contacts.mark-read');
        // ... di dalam group admin ...
        Route::resource('users', \App\Http\Controllers\Admin\AdminUserController::class);
        Route::resource('courses', \App\Http\Controllers\Admin\AdminCourseController::class);

        // Tambahan khusus untuk manage materi/lessons nanti (persiapan Langkah 3)
        Route::get('courses/{course}/lessons/create', [\App\Http\Controllers\Admin\AdminCourseController::class, 'createLesson'])->name('courses.lessons.create');
        Route::post('courses/{course}/lessons', [\App\Http\Controllers\Admin\AdminCourseController::class, 'storeLesson'])->name('courses.lessons.store');
        Route::delete('lessons/{courseLesson}', [\App\Http\Controllers\Admin\AdminCourseController::class, 'destroyLesson'])->name('lessons.destroy');
    });

// Load auth routes
require __DIR__ . '/auth.php';
