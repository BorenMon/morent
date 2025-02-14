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
    // CRUD Staffs
    Route::group([
        'prefix' => '/staffs',
        'middleware' => ['role:ADMIN,MANAGER'],
        'as' => 'staffs'
    ], function () {
        Route::get('', [UserController::class, 'staffsIndex']);
        Route::get('/create', [UserController::class, 'staffsCreate'])
            ->name('.create');
        Route::post('', [UserController::class, 'staffsStore'])
            ->name('.store');
        Route::get('/{user}', [UserController::class, 'staffsShow'])
            ->name('.show');
        Route::get('/{user}/edit', [UserController::class, 'staffsEdit'])
            ->name('.edit');
        Route::put('/{user}', [UserController::class, 'staffsUpdate'])
            ->name('.update');
        Route::delete('/{user}', [UserController::class, 'staffsDestroy'])
            ->name('.destroy');
    });

    // CRUD Customers
    Route::group([
        'prefix' => '/customers',
        'as' => 'customers'
    ], function () {
        Route::get('', [UserController::class, 'customersIndex']);
        Route::get('/create', [UserController::class, 'customersCreate'])
            ->name('.create');
        Route::post('', [UserController::class, 'customersStore'])
            ->name('.store');
        Route::get('/{user}', [UserController::class, 'customersShow'])
            ->name('.show');
        Route::get('/{user}/edit', [UserController::class, 'customersEdit'])
            ->name('.edit');
        Route::put('/{user}', [UserController::class, 'customersUpdate'])
            ->name('.update');
        Route::delete('/{user}', [UserController::class, 'customersDestroy'])
            ->name('.destroy');
    });

    Route::get('', fn() => view('admin.pages.dashboard'))->name('dashboard');
    Route::get('profile', fn() => view('admin.pages.profile'))->name('profile');
});
