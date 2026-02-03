<?php

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
    return view('layouts.app');
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
Route::get('/about', function () {
    return view('aboutschool.index');
});
Route::get('/login', function () {
    return view('admin.news.index');
});
Route::get('/hero-animation', function () {
    return view('layouts.hero-animation');
});



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
