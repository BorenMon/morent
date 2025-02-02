<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\UserController;

Route::group([
    'prefix' => '/admin',
    'middleware' => ['auth', 'role:MANAGER,STAFF,ADMIN'],
    'as' => 'admin.'
], function () {
    Route::resource('cars', CarController::class);

    Route::resource('users', UserController::class);
    Route::post('/users/{user}/avatar', [UserController::class, 'updateAvatar'])->name('users.avatar');

    Route::get('', fn() => view('admin.dashboard'))->name('dashboard');
    Route::get('profile', fn() => view('admin.profile'))->name('profile');
});
