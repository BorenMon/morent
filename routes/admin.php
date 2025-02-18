<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CarController;

Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('admin.login');

Route::group([
    'prefix' => '/admin',
    'middleware' => ['auth', 'role:MANAGER,STAFF,ADMIN'],
    'as' => 'admin.'
], function () {
    // CRUD Staffs
    Route::group([
        'prefix' => '/staffs',
        'middleware' => ['role:ADMIN,MANAGER'],
        'as' => 'staffs'
    ], function () {
        Route::get('', [StaffController::class, 'staffsIndex']);
        Route::get('/create', [StaffController::class, 'staffsCreate'])
            ->name('.create');
        Route::post('', [StaffController::class, 'staffsStore'])
            ->name('.store');
        Route::get('/{user}', [StaffController::class, 'staffsShow'])
            ->name('.show');
        Route::get('/{user}/edit', [StaffController::class, 'staffsEdit'])
            ->name('.edit');
        Route::put('/{user}', [StaffController::class, 'staffsUpdate'])
            ->name('.update');
        Route::delete('/{user}', [StaffController::class, 'staffsDestroy'])
            ->name('.destroy');
    });

    // CRUD Customers
    Route::group([
        'prefix' => '/customers',
        'as' => 'customers'
    ], function () {
        Route::get('', [CustomerController::class, 'customersIndex']);
        Route::get('/create', [CustomerController::class, 'customersCreate'])
            ->name('.create');
        Route::post('', [CustomerController::class, 'customersStore'])
            ->name('.store');
        Route::get('/{user}', [CustomerController::class, 'customersShow'])
            ->name('.show');
        Route::get('/{user}/edit', [CustomerController::class, 'customersEdit'])
            ->name('.edit');
        Route::put('/{user}', [CustomerController::class, 'customersUpdate'])
            ->name('.update');
        Route::delete('/{user}', [CustomerController::class, 'customersDestroy'])
            ->name('.destroy');
    });

    // CRUD Cars
    Route::group([
        'prefix' => '/cars',
        'as' => 'cars'
    ], function () {
        Route::get('', [CarController::class, 'index']);
        Route::get('/create', [CarController::class, 'create'])
            ->name('.create');
        Route::post('', [CarController::class, 'store'])
            ->name('.store');
        Route::get('/{car}', [CarController::class, 'show'])
            ->name('.show');
        Route::get('/{car}/edit', [CarController::class, 'edit'])
            ->name('.edit');
        Route::put('/{car}', [CarController::class, 'update'])
            ->name('.update');
        Route::delete('/{car}', [CarController::class, 'destroy'])
            ->name('.destroy');
    });

    // CRUD Bookings
    Route::group([
        'prefix' => '/bookings',
        'as' => 'bookings'
    ], function () {
        Route::get('', [AdminController::class, 'index']);
        Route::get('/{booking}', [AdminController::class, 'show'])
            ->name('.show');
    });

    Route::get('', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', fn() => view('admin.pages.profile'))->name('profile');
});
