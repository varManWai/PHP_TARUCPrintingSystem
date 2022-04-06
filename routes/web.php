<?php
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ReportController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;


//Do not required auth
Route::get('/register', [RegisterController::class, 'index']) -> name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index']) -> name('login');
Route::post('/login', [LoginController::class, 'store']);


//Required auth
Auth::routes();


//USER
//Dashboard
Route::get('/dashboard', [UsersController::class, 'index'])-> name('dashboard');

//Faculty
Route::get('/faculty',[FacultyController::class, 'index']) -> name('addFaculty');
Route::post('/faculty',[FacultyController::class,'store']);

//Order
Route::get('/order',[OrderController::class, 'index']) -> name('Order');
Route::post('/order',[OrderController::class,'addCart']) -> name('AddCart');

//Home Page
// Route::get('/editUser', [UserController::class, 'edit'])->name('editUser');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/',[HomeController::class, 'index']);


//ADMIN
//Report
Route::get('/123', function () {
    return view('report.report');
});
Route::post('/generateDaily',[ReportController::class,'generateDaily'])->name('generateDaily');
Route::post('/generateMonthly',[ReportController::class,'generateMonthly'])->name('generateMonthly');
Route::post('/generateYearly',[ReportController::class,'generateYearly'])->name('generateYearly');



