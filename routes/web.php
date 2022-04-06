<?php
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FacultyController;
use Illuminate\Support\Facades\Route;


Route::get('/register', [RegisterController::class, 'index']) -> name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index']) -> name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/dashboard', [UsersController::class, 'index'])-> name('dashboard');

Route::get('/faculty',[FacultyController::class, 'index']) -> name('addFaculty');
Route::post('/faculty',[FacultyController::class,'store']);

Route::post('/order',[OrderController::class,'addCart']) -> name('AddCart');
Route::get('/', function () {
    return view('components.index');
});
