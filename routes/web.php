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

Route::get('/kadin/disposisi', function () {
    return view('disposisi-masuk');
});

Route::get('/registrasi-surat', function () {
    return view('registrasi-surat');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/admin/users', function () {
    return view('manajemen-user');
});
