<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::group([
    'prefix' => '',
    'as' => 'client.'
], function () {
    Route::get('', fn() => view('client.home'))->name('home');
    Route::get('/cars', fn() => view('client.cars'))->name('cars');
    Route::get('/detail', fn() => view('client.detail'))->name('detail');
    
    Route::get('/payment', fn() => view('client.payment'))
        ->middleware('auth')
        ->name('payment');
    Route::get('/profile', fn() => view('client.profile'))
        ->middleware('auth')
        ->name('profile');

    Route::get('/auth', fn() => view('client.auth'))->middleware('guest')->name('auth');
    Route::post('/register', [RegisteredUserController::class, 'storeCustomer'])->name('register');
});
