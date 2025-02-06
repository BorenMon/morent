<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::group([
    'prefix' => '/admin',
    'middleware' => ['auth', 'role:MANAGER,STAFF,ADMIN'],
    'as' => 'admin.'
], function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

    Route::resource('cars', CarController::class);

    Route::resource('users', UserController::class);
    Route::post('/users/{user}/avatar', [UserController::class, 'updateAvatar'])->name('users.avatar');

    Route::get('', fn() => view('admin.dashboard'))->name('dashboard');
    Route::get('profile', fn() => view('admin.profile'))->name('profile');
});
