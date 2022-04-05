<?php
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use Illuminate\Support\Facades\Route;


Route::get('/register', [RegisterController::class, 'index']) -> name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index']) -> name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/dashboard', [UsersController::class, 'index'])-> name('dashboard');

Route::get('/', function () {
    return view('components.index');
});
