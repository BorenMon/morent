<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::group([
    'prefix' => '',
    'as' => 'client.'
], function () {
    Route::get('', fn() => view('client.home'))->name('home');
    Route::get('/cars', fn() => view('client.cars'))->name('cars');
    Route::get('/detail', fn() => view('client.detail'))->name('detail');

    Route::group([
        'middleware' => ['auth', 'role:CUSTOMER']
    ], function () {
        Route::get('/payment', fn() => view('client.payment'))
        ->name('payment');
        Route::get('/profile', fn() => view('client.profile'))
            ->name('profile');
    });

    Route::get('/auth', fn() => view('client.auth'))->middleware('guest')->name('auth');
    Route::post('/register', [RegisteredUserController::class, 'storeCustomer'])->name('register');

    Route::post('/id-card/{user}', [UserController::class, 'uploadIdCard'])->name('id-card');
    Route::delete('/id-card/{user}', [UserController::class, 'removeIdCard'])->name('id-card');
    Route::post('driving-license/{user}', [UserController::class, 'uploadDrivingLicense'])->name('driving-license');
    Route::delete('driving-license/{user}', [UserController::class, 'removeDrivingLicense'])->name('driving-license');
});
