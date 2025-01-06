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
    ->namespace('Admin')
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('absence', 'AbsenceController@index')->name('absence.index');
        Route::namespace('Master')
            ->group(function () {
                Route::resource('user', 'UserController')->except('show');
                Route::resource('work-unit', 'WorkUnitController')->except('show');
                Route::resource('position', 'PositionController')->except('show');
                Route::resource('information', 'InformationController')->except('show');
                Route::resource('fingerprint', 'FingerprintController')->except('show');
                Route::resource('employee', 'EmployeeController')->except('show');
            });
    });
