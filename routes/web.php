<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CurriculumController;



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
Route::get('/login', function () {
    return view('admin.news.index');
});
Route::get('/hero-animation', function () {
    return view('layouts.hero-animation');
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