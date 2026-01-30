<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CurriculumController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/layout', function () {
    return view('layouts.app');
});
Route::get('/prokeh', function () {
    return view('program_keahlian.index');
});

Route::get('/news', function () {
    return view('news.app');
});
Route::get('/login', function () {
    return view('admin.news.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Login Page (Public)
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    
    // Dashboard (Protected - perlu auth)
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        // News Management
        Route::resource('news', NewsController::class);
        Route::post('news/{news}/toggle-publish', [NewsController::class, 'togglePublish'])
             ->name('news.toggle-publish');
    });
});