<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdmin;

// Import Controller Creator Hub
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CampaignController; // BARU: Client Campaign

// Import Controller Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminTalentController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminCampaignController; // BARU: Admin Campaign

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

// Talent List (Public)
Route::get('/talents', [TalentController::class, 'index'])->name('talents.index');
Route::get('/talents/{talent}', [TalentController::class, 'show'])->name('talents.show');

// Contact Form
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Courses (Public List)
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

// === NEW: CAMPAIGN FLOW (Client Side) ===
Route::get('/campaign/start', [CampaignController::class, 'create'])->name('campaigns.create');
Route::post('/campaign/select', [CampaignController::class, 'selectTalents'])->name('campaigns.select');
Route::post('/campaign/finish', [CampaignController::class, 'store'])->name('campaigns.store');


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

    Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('courses.my');
    
    // Learning Flow
    Route::get('/courses/{course:slug}/learn', [CourseController::class, 'learning'])->name('courses.start');
    Route::get('/courses/{course:slug}/learn/{lesson}', [CourseController::class, 'learning'])->name('courses.learning');
});


// ==========================================
// 3. ADMIN ROUTES (Khusus Role Admin)
// ==========================================

Route::middleware(['auth', IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Resource Management
        Route::resource('talents', AdminTalentController::class);
        Route::resource('users', AdminUserController::class);
        Route::resource('courses', AdminCourseController::class);
        
        // === NEW: CAMPAIGN MANAGEMENT (Admin Side) ===
        Route::resource('campaigns', AdminCampaignController::class);
        // Custom Actions for Campaign
        Route::patch('/campaigns/{campaign}/talent/{talent}', [AdminCampaignController::class, 'updateTalentStatus'])->name('campaigns.talent.update');
        Route::post('/campaigns/{campaign}/add-talent', [AdminCampaignController::class, 'addTalent'])->name('campaigns.talent.add');

        // Course Lessons Management
        Route::get('courses/{course}/lessons/create', [AdminCourseController::class, 'createLesson'])->name('courses.lessons.create');
        Route::post('courses/{course}/lessons', [AdminCourseController::class, 'storeLesson'])->name('courses.lessons.store');
        Route::delete('lessons/{courseLesson}', [AdminCourseController::class, 'destroyLesson'])->name('lessons.destroy');

        // Contacts / Inbox
        Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
        Route::patch('/contacts/{contact}/mark-read', [AdminController::class, 'markRead'])->name('contacts.mark-read');
    });

require __DIR__ . '/auth.php';