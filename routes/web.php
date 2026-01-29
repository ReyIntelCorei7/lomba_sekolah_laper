<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/layout', function () {
    return view('layouts.app');
});
Route::get('/news', function () {
    return view('news.index');
});
Route::get('/about', function () {
    return view('aboutschool.index');
});

