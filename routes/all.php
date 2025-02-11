<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::group([
    'prefix' => '/users',
    'as' => 'users.',
    'middleware' => ['auth']
], function () {
    Route::patch('/{user}/avatar', [UserController::class, 'updateAvatar'])
    ->name('avatar');
    Route::patch('/{user}/info', [UserController::class, 'updateInfo'])
    ->name('info');
    Route::patch('/{user}/password', [UserController::class, 'updatePassword'])
    ->name('password');
});
