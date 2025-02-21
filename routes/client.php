<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClientController;

Route::group([
    'prefix' => '',
    'as' => 'client.'
], function () {
    Route::get('', [ClientController::class, 'home'])->name('home');
    Route::get('/cars', fn() => view('client.cars'))->name('cars');
    Route::get('/cars/{car}', [ClientController::class, 'detail'])->name('detail');

    Route::group([
        'middleware' => ['auth', 'role:CUSTOMER']
    ], function () {
        Route::get('/cars/{car}/payment', [ClientController::class, 'payment'])
        ->name('payment');
        Route::get('/profile', fn() => view('client.profile'))
            ->name('profile');
        Route::post('/book', [ClientController::class, 'book'])->name('book');
    });

    Route::get('/auth', fn() => view('client.auth'))->middleware('guest')->name('auth');
    Route::post('/register', [RegisteredUserController::class, 'storeCustomer'])->name('register');

    Route::post('id-card/{user}', [ClientController::class, 'uploadIdCard'])->name('upload-id-card');
    Route::delete('id-card/{user}', [ClientController::class, 'removeIdCard'])->name('remove-id-card');
    Route::post('driving-license/{user}', [ClientController::class, 'uploadDrivingLicense'])->name('upload-driving-license');
    Route::delete('driving-license/{user}', [ClientController::class, 'removeDrivingLicense'])->name('remove-driving-license');
});
