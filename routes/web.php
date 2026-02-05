<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use Illuminate\Support\Facades\Route;

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
Route::get('/kurikulum', function () {
    return view('kurikulum.app');
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
