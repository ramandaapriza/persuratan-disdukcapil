<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/kadin', function () {
    return view('dashboard-kadin');
});

Route::get('/kadin/validasi', function () {
    return view('validasi-ttd');
});
