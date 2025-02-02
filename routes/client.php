<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '',
    'as' => 'client.'
], function () {
    Route::get('', function () {
        return view('client.home'); // Correct way to render a view
    })->name('home');
});
