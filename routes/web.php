<?php
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\RegisterController;
<<<<<<< HEAD
use App\Http\Controllers\OrderController;
=======
use App\Http\Controllers\Auth\LoginController;

>>>>>>> 0eab9e8cf677cb7f9a192dc091c304e8ac412d7a
use Illuminate\Support\Facades\Route;


Route::get('/register', [RegisterController::class, 'index']) -> name('register');
Route::post('/register', [RegisterController::class, 'store']);
<<<<<<< HEAD
Route::get('/subjects',[OrderController::class, 'index']) -> name('subjects');
=======
Route::get('/login', [LoginController::class, 'index']) -> name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/dashboard', [UsersController::class, 'index'])-> name('dashboard');
>>>>>>> 0eab9e8cf677cb7f9a192dc091c304e8ac412d7a

Route::get('/', function () {
    return view('components.index');
});
