<?php

use Illuminate\Support\Facades\Route;


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



Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/', function () {
            return view('admin.layout.app');
        })->name('dashboard');

        // News Management - ubah prefix/name
        Route::resource('news', App\Http\Controllers\Admin\NewsController::class)
            ->parameters(['news' => 'news']);

        Route::post(
            'news/{news}/toggle-publish',
            [App\Http\Controllers\Admin\NewsController::class, 'togglePublish']
        )->name('news.toggle-publish');
    });
