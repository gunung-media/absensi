<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

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
        Route::prefix('report')->name('report.')->group(function () {
            Route::get('/', 'ReportController@index')->name('index');
            Route::get('/absence', 'ReportController@absence')->name('absence');
        });
        Route::resource('employee', 'EmployeeController')->except('show');

        Route::namespace('Master')
            ->group(function () {
                Route::resource('user', 'UserController')->except('show');
                Route::resource('work-unit', 'WorkUnitController')->except('show');
                Route::resource('position', 'PositionController')->except('show');
                Route::resource('rank', 'RankController')->except('show');
                Route::resource('placement', 'PlacementController')->except('show');
                Route::resource('information', 'InformationController')->except('show');
                Route::resource('fingerprint', 'FingerprintController')->except('show');
            });
    });
