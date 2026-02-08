<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\EskulController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\ExtracurricularController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;



// ============================================================================
// PUBLIC ROUTES
// ============================================================================

// Homepage 
Route::get('/', function () {
    $settings = \App\Models\WebsiteSetting::all()->pluck('value', 'key');
    $latestNews = \App\Models\News::where('is_published', true)
        ->latest('published_at')
        ->limit(3)
        ->get();
    $programs = \App\Models\Program::active()->get();

    return view('layouts.app', compact('settings', 'latestNews', 'programs'));
})->name('home');

// News (Public)
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/load-more', [NewsController::class, 'loadMoreNews'])->name('load-more');
    Route::get('/kategori/{category}', [NewsController::class, 'category'])->name('category');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

// Static pages
Route::get('/news', [NewsController::class, 'showNewsPage'])->name('news.page');
Route::get('/about', fn() => view('aboutschool.index'))->name('about');
Route::get('/kurikulum', fn() => view('kurikulum.app'))->name('kurikulum');

// ============================================================================
// PROGRAM KEAHLIAN ROUTES
// ============================================================================

Route::prefix('prokeh')->name('prokeh.')->group(function () {
    Route::get('/', fn() => view('program_keahlian.index'))->name('index');
    Route::get('/akuntansi', fn() => view('program_keahlian.akuntansi'))->name('akuntansi');
    Route::get('/dkv', fn() => view('program_keahlian.dkv'))->name('dkv');
    Route::get('/pplg', fn() => view('program_keahlian.pplg'))->name('pplg');
    Route::get('/kuliner', fn() => view('program_keahlian.kuliner'))->name('kuliner');
    Route::get('/hotel', fn() => view('program_keahlian.hotel'))->name('hotel');
});

//
// AUTH ROUTES
// 

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// ============================================================================
// EXTRACURRICULAR (ESKUL) ROUTES
// ============================================================================

Route::prefix('eskul')->name('eskul.')->group(function () {
    Route::get('/', [EskulController::class, 'index'])->name('index');
    Route::get('/{slug}', [EskulController::class, 'show'])->name('show');
});

// 
// PPDB ROUTES (Penerimaan Peserta Didik Baru)
// 

Route::prefix('ppdb')->name('ppdb.')->group(function () {
    Route::get('/', [PPDBController::class, 'index'])->name('index');
    Route::get('/register', [PPDBController::class, 'create'])->name('create');
    Route::post('/register', [PPDBController::class, 'store'])->name('store');
    Route::get('/success/{registrationNumber}', [PPDBController::class, 'success'])->name('success');
    Route::get('/check', [PPDBController::class, 'check'])->name('check');
    Route::post('/status', [PPDBController::class, 'status'])->name('status');
});

// ============================================================================
// ADMIN ROUTES
// ============================================================================

Route::prefix('admin')->name('admin.')->group(function () {

    // Public admin routes (login page)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');

    // Protected admin routes (requires authentication)
    Route::middleware(['admin.auth'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Students Management
        Route::resource('students', StudentController::class)->except(['create', 'store']);
        Route::patch('students/{student}/status', [StudentController::class, 'updateStatus'])
            ->name('students.update-status');
        Route::get('students/export', [StudentController::class, 'export'])
            ->name('students.export');

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
        Route::patch('news/{news}/toggle-publish', [NewsController::class, 'togglePublish'])
            ->name('news.toggle-publish');

        // Website Settings
        Route::get('settings', [WebsiteSettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [WebsiteSettingController::class, 'update'])->name('settings.update');

        // Extracurriculars Management
        Route::resource('extracurriculars', ExtracurricularController::class);
        Route::patch('extracurriculars/{extracurricular}/toggle-active', [ExtracurricularController::class, 'toggleActive'])
            ->name('extracurriculars.toggle-active');
    });
});

// ============================================================================
// FALLBACK ROUTE (404)
// ============================================================================

Route::fallback(fn() => view('errors.404'));
