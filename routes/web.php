<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\LoginController;


// ==================== PUBLIC ROUTES ====================

// Homepage
Route::get('/', function () {
    return view('home'); // Pastikan ada file home.blade.php
})->name('home');

// News Routes (Public)
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/berita/kategori/{category}', [NewsController::class, 'category'])->name('news.category');

// // Program Routes
// Route::get('/program', [ProgramController::class, 'index'])->name('program.index');

// // About Routes
// Route::get('/tentang', [AboutController::class, 'index'])->name('about');

// // Curriculum Routes
// Route::get('/kurikulum', [CurriculumController::class, 'index'])->name('curriculum.index');

// ==================== AUTH ROUTES ====================

// Login Routes - HAPUS DUPLIKAT
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// ==================== ADMIN ROUTES (Protected) ====================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // News Management
    Route::resource('news', NewsController::class);
    Route::post('news/{news}/toggle-publish', [NewsController::class, 'togglePublish'])
         ->name('news.toggle-publish');
    
    // ... routes admin lainnya
});

// ==================== DEVELOPMENT/TESTING ROUTES ====================
// HAPUS INI SETELAH DEVELOPMENT SELESAI

// Route testing layout
Route::get('/test-layout', function () {
    return view('layouts.app');
});

// Route testing program
Route::get('/test-program', function () {
    return view('program.index');
});

// Route testing news
Route::get('/test-news', function () {
    return view('news.index');
});
Route::get('/', function () {
    $settings = \App\Models\WebsiteSetting::all()->pluck('value', 'key');
    $latestNews = \App\Models\News::where('is_published', true)
        ->latest('published_at')
        ->limit(3)
        ->get();
    $programs = \App\Models\Program::active()->get();
    
    return view('layouts.app', compact('settings', 'latestNews', 'programs'));
});

Route::get('/prokeh/akuntansi', function () {
    return view('program_keahlian.akuntansi');
});
Route::get('/prokeh/DKV', function () {
    return view('program_keahlian.dkv');
});
Route::get('/prokeh/PPLG', function () {
    return view('program_keahlian.pplg');
});
Route::get('/prokeh/Kuliner', function () {
    return view('program_keahlian.kuliner');
});
Route::get('/prokeh/Hotel', function () {
    return view('program_keahlian.hotel');
});
Route::get('/news', function () {
    return view('news.app');
});
<<<<<<< HEAD
Route::get('/kurikulum', function () {
    return view('kurikulum.app');
=======
Route::get('/about', function () {
    return view('aboutschool.index');
});
Route::get('/login', function () {
    return view('admin.news.index');
>>>>>>> 6c021719aa95254dd1769b7c72066c3020caad2d
});

// PPDB Routes
Route::prefix('ppdb')->name('ppdb.')->group(function () {
    Route::get('/', [PPDBController::class, 'index'])->name('index');
    Route::get('/register', [PPDBController::class, 'create'])->name('create');
    Route::post('/register', [PPDBController::class, 'store'])->name('store');
    Route::get('/success/{registrationNumber}', [PPDBController::class, 'success'])->name('success');
    Route::get('/check', [PPDBController::class, 'check'])->name('check');
    Route::post('/status', [PPDBController::class, 'status'])->name('status');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Public admin routes (login)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    
    // Protected admin routes
    Route::middleware(['admin.auth'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Students Management
        Route::resource('students', StudentController::class)->except(['create', 'store']);
        Route::patch('students/{student}/status', [StudentController::class, 'updateStatus'])->name('students.update-status');
        Route::get('students/export', [StudentController::class, 'export'])->name('students.export');
        
        // Programs Management
        Route::resource('programs', ProgramController::class);
        
        // News Management
        Route::get('news', [NewsController::class, 'adminIndex'])->name('news.index');
        Route::get('news/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('news', [NewsController::class, 'store'])->name('news.store');
        Route::get('news/{news}', [NewsController::class, 'adminShow'])->name('news.show');
        Route::get('news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('news/{news}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
        Route::patch('news/{news}/toggle-publish', [NewsController::class, 'togglePublish'])->name('news.toggle-publish');
        
        // Website Settings
        Route::get('settings', [WebsiteSettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [WebsiteSettingController::class, 'update'])->name('settings.update');
    });
});

Route::get('/hero-animation', function () {
    return view('layouts.hero-animation');
});
<<<<<<< HEAD
=======



// ==================== FALLBACK ====================
Route::fallback(function () {
    return view('errors.404');
});

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Login Page (Public)
    Route::get('/login', function () {
        return view('admin.auth.login');
    })->name('login');
    
    // Dashboard (Protected - perlu auth)
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.layout.app');
        })->name('dashboard');
        
        // News Management
        Route::resource('news', NewsController::class);
        Route::post('news/{news}/toggle-publish', [NewsController::class, 'togglePublish'])
             ->name('news.toggle-publish');
    });
});
>>>>>>> 6c021719aa95254dd1769b7c72066c3020caad2d
