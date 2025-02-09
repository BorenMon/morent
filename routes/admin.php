<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('admin.login');

Route::group([
    'prefix' => '/admin',
    'middleware' => ['auth', 'role:MANAGER,STAFF,ADMIN'],
    'as' => 'admin.'
], function () {
    Route::resource('cars', CarController::class);

    Route::resource('users', UserController::class);
    Route::post('/users/{user}/avatar', [UserController::class, 'updateAvatar'])->name('users.avatar');

    Route::get('', fn() => view('admin.pages.dashboard'))->name('dashboard');
    Route::get('profile', fn() => view('admin.pages.profile'))->name('profile');
});
