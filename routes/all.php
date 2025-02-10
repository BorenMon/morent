<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::patch('/users/{user}/avatar', [UserController::class, 'updateAvatar'])->name('users.avatar');