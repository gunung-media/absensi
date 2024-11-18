<?php

use Illuminate\Support\Facades\Route;

Route::prefix('login')
    ->name('login')
    ->middleware('guest')
    ->group(function () {
        Route::get('', 'Auth\LoginController@showLoginForm');
        Route::post('', 'Auth\LoginController@login')->name('.post');
    });

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
    });
