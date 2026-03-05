<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\EskulController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\AlumniPublicController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;

use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;

use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\ExtracurricularController;
use App\Http\Controllers\Admin\OrganizationController;

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


// Serve images stored as base64 in the database
Route::get('/img/{table}/{id}/{column}', [\App\Http\Controllers\ImageController::class, 'show'])
    ->name('image.show');

// Serve uploaded files from storage (works in all environments)
Route::get('/storage/{path}', function ($path) {
    // Try local storage first
    $localPath = storage_path('app/public/' . $path);
    
    // Then try /tmp/storage for production (Vercel)
    $tmpPath = '/tmp/storage/' . $path;
    
    if (file_exists($localPath)) {
        $fullPath = $localPath;
    } elseif (file_exists($tmpPath)) {
        $fullPath = $tmpPath;
    } else {
        abort(404);
    }
    
    $mimeType = mime_content_type($fullPath);
    return response()->file($fullPath, ['Content-Type' => $mimeType]);
})->where('path', '.*')->name('storage.serve');

// USER ROUTES

// Homepage 
Route::get('/', function () {
    try {
        $settings = \App\Models\WebsiteSetting::all()->pluck('value', 'key');
        $latestNews = \App\Models\News::where('is_published', true)
            ->latest('published_at')
            ->limit(3)
            ->get();
        $programs = \App\Models\Program::active()->get();
    } catch (\Exception $e) {
        $settings = collect();
        $latestNews = collect();
        $programs = collect();
    }

    return view('layouts.app', compact('settings', 'latestNews', 'programs'));
})->name('home');

// News 
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


// PROGRAM KEAHLIAN ROUTES


Route::prefix('prokeh')->name('prokeh.')->group(function () {
    Route::get('/', fn() => view('program_keahlian.index'))->name('index');
    Route::get('/akuntansi', fn() => view('program_keahlian.akuntansi'))->name('akuntansi');
    Route::get('/dkv', fn() => view('program_keahlian.dkv'))->name('dkv');
    Route::get('/hotel', fn() => view('program_keahlian.hotel'))->name('hotel');
    Route::get('/kuliner', fn() => view('program_keahlian.kuliner'))->name('kuliner');
    Route::get('/pplg', fn() => view('program_keahlian.pplg'))->name('pplg');
});


// AUTH ROUTES (with rate limiting)


Route::middleware(['throttle:5,1'])->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');


//  ESKUL ROUTES


Route::prefix('eskul')->name('eskul.')->group(function () {
    Route::get('/', [EskulController::class, 'index'])->name('index');
    Route::get('/{slug}', [EskulController::class, 'show'])->name('show');
});


// ORGANISASI ROUTES


Route::prefix('organisasi')->name('organisasi.')->group(function () {
    Route::get('/', [OrganisasiController::class, 'index'])->name('index');
    Route::get('/{slug}', [OrganisasiController::class, 'show'])->name('show');
});

// ALUMNI ROUTES


Route::get('/alumni', [AlumniPublicController::class, 'index'])->name('alumni.index');


// PPDB ROUTES (with rate limiting)


Route::prefix('ppdb')->name('ppdb.')->group(function () {
    Route::get('/', [PPDBController::class, 'index'])->name('index');
    Route::get('/register', [PPDBController::class, 'create'])->name('create');
    Route::post('/register', [PPDBController::class, 'store'])->name('store')->middleware('throttle:3,1');
    Route::get('/success/{registrationNumber}', [PPDBController::class, 'success'])->name('success');
    Route::get('/check', [PPDBController::class, 'check'])->name('check');
    Route::post('/status', [PPDBController::class, 'status'])->name('status')->middleware('throttle:10,1');
    Route::get('/verify-email', [PPDBController::class, 'verifyEmail'])->name('verify-email');
});


// Smile route

Route::get('/smile', function () {
    return redirect('https://smile-metschoo.com');
});



// ADMIN ROUTES


Route::prefix('admin')->name('admin.')->group(function () {

    // Login (with rate limiting: 5 attempts per minute)
    Route::middleware(['throttle:5,1'])->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    });



    // Authenticated routes
    Route::middleware(['admin.auth'])->group(function () {
        // Logout
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



        // Students
        Route::resource('students', StudentController::class)->except(['create', 'store']);
        Route::patch('students/{student}/status', [StudentController::class, 'updateStatus'])
            ->name('students.update-status');
        Route::get('students/export', [StudentController::class, 'export'])
            ->name('students.export');

        // News
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

        // Extracurriculars
        Route::resource('extracurriculars', ExtracurricularController::class);
        Route::patch('extracurriculars/{extracurricular}/toggle-active', [ExtracurricularController::class, 'toggleActive'])
            ->name('extracurriculars.toggle-active');

        // Organizations
        Route::resource('organizations', OrganizationController::class);
        Route::patch('organizations/{organization}/toggle-active', [OrganizationController::class, 'toggleActive'])
            ->name('organizations.toggle-active');

        // Alumni
        Route::resource('alumni', AlumniController::class);
        Route::patch('alumni/{alumni}/toggle-active', [AlumniController::class, 'toggleActive'])
            ->name('alumni.toggle-active');

        // Audit Logs
        Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');

    });
});



// Not Found Page

Route::fallback(fn() => view('errors.404'));
