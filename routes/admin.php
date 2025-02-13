<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserController;

Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('admin.login');

Route::group([
    'prefix' => '/admin',
    'middleware' => ['auth', 'role:MANAGER,STAFF,ADMIN'],
    'as' => 'admin.'
], function () {
    Route::group([
        'middleware' => ['role:ADMIN,MANAGER']
    ], function () {
        Route::get('/staffs', [UserController::class, 'staffsIndex'])
            ->name('staffs');
        Route::get('/staffs/create', [UserController::class, 'staffsCreate'])
            ->name('staffs.create');
        Route::post('/staffs', [UserController::class, 'staffsStore'])
            ->name('staffs.store');
        Route::delete('/staffs/{user}', [UserController::class, 'staffsDestroy'])
            ->name('staffs.destroy');
    });

    Route::get('', fn() => view('admin.pages.dashboard'))->name('dashboard');
    Route::get('profile', fn() => view('admin.pages.profile'))->name('profile');
});
