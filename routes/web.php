<?php
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Route::get('/register', [RegisterController::class, 'index']) -> name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index']) -> name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/dashboard', [UsersController::class, 'index'])-> name('dashboard');

Route::get('/order',[OrderController::class, 'index']) -> name('Order');
Route::post('/order',[OrderController::class,'addCart']) -> name('AddCart');





Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/123', function () {
    return view('report.report');
});

route::post('/generateDaily',[ReportController::class,'generateDaily'])->name('generateDaily');
route::post('/generateMonthly',[ReportController::class,'generateMonthly'])->name('generateMonthly');
route::post('/generateYearly',[ReportController::class,'generateYearly'])->name('generateYearly');


Route::get('/',[HomeController::class, 'index']);
