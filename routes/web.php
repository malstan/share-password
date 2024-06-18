<?php

use App\Http\Controllers\PasswordShareController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PasswordShareController::class, 'index']);
Route::post('password', [PasswordShareController::class, 'store']);

Route::get('heslo/{id}', [PasswordShareController::class, 'collecting']);
Route::get('heslo/zis/{id}', [PasswordShareController::class, 'collect']);
