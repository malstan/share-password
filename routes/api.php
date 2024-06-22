<?php

use App\Http\Controllers\PasswordShareController;
use Illuminate\Support\Facades\Route;

Route::controller(PasswordShareController::class)->group(function() {
    Route::post('password', 'store');

    Route::get('password/{uuid}', 'collect');
});


