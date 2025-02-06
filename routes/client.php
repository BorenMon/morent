<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::group([
    'prefix' => '',
    'as' => 'client.'
], function () {
    Route::get('', function () {
        return view('client.home');
    })->name('home');
    Route::get('/cars', function () {
        return view('client.cars');
    })->name('cars');
    Route::get('/detail', function () {
        return view('client.detail');
    })->name('detail');
    Route::get('/payment', function () {
        return view('client.payment');
    })->name('payment');
    Route::get('/profile', function () {
        return view('client.profile');
    })->name('profile');

    Route::get('/auth', fn () => view('client.auth'))->name('auth');

    Route::post('/register', [RegisteredUserController::class, 'storeCustomer'])
    ->name('register');
});
