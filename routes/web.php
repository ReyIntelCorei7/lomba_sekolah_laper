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

