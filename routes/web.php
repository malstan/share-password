<?php

use App\Http\Controllers\PasswordShareController;
use Illuminate\Support\Facades\Route;

Route::controller(PasswordShareController::class)->group(function() {
    Route::get('/', 'index');
    Route::get('heslo', function() {
        return redirect('/');
    });
    Route::get('heslo/link', function() {
        return redirect('/');
    });

    Route::post('heslo/link', 'store');

    Route::post('heslo', 'collect');
    
    Route::get('heslo/{hash}', 'collecting');
});
