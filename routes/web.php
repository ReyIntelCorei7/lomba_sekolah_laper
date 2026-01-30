<?php

use Illuminate\Support\Facades\Route;

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
    return view('news.index');
});
Route::get('/login', function () {
    return view('admin.news.index');
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
