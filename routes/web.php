<?php

use Illuminate\Support\Facades\Route;


Route::name('absence.')->group(function () {
    Route::get('/', 'AbsenceController@newAbsenceFromEmployee')->name('index');
    Route::post('/', 'AbsenceController@storeAbsenceFromEmployee')->name('store');
});

Route::prefix('login')
    ->name('login')
    ->middleware('guest')
    ->group(function () {
        Route::get('', 'Auth\LoginController@showLoginForm');
        Route::post('', 'Auth\LoginController@login')->name('.post');
    });

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->namespace('Admin')
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::resource('absent', 'AbsentController')->except('show');
        Route::resource('absence', 'AbsenceController')->except('show');
        Route::get('abs_sync', 'AbsenceController@sync')->name('absence.sync');

        Route::prefix('report')->name('report.')->group(function () {
            Route::get('/', 'ReportController@index')->name('index');
            Route::get('/absence', 'ReportController@absence')->name('absence');
            Route::get('/performance', 'ReportController@performance')->name('performance');
            Route::get('/performance/satpel', 'ReportController@performanceSatpel')->name('performance.satpel');
        });
        Route::resource('employee', 'EmployeeController')->except('show');

        Route::namespace('Master')
            ->group(function () {
                Route::resource('user', 'UserController')->except('show');
                Route::resource('work-unit', 'WorkUnitController')->except('show');
                Route::resource('work-shift', 'WorkShiftController')->except('show');
                Route::resource('position', 'PositionController')->except('show');
                Route::resource('rank', 'RankController')->except('show');
                Route::resource('placement', 'PlacementController')->except('show');
                Route::resource('information', 'InformationController')->except('show');
                Route::resource('fingerprint', 'FingerprintController')->except('show');
            });
    });
