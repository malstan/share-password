<?php

use App\Http\Controllers\PasswordShareController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PasswordShareController::class, 'index']);

Route::get('heslo/{hash}', [PasswordShareController::class, 'collecting']);