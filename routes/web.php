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
        Route::resource('user', 'Admin\UserController')->except('show');
        Route::resource('work-unit', 'Admin\WorkUnitController')->except('show');
        Route::resource('position', 'Admin\PositionController')->except('show');
    });
