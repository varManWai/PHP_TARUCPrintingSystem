<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::get('/register', [RegisterController::class, 'index']) -> name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/subjects',[OrderController::class, 'index']) -> name('subjects');

Route::get('/', function () {
    return view('components.index');
});
