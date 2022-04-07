<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//USER
//Do not required auth
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

//ADMIN
//Do not required auth
Route::get('/adminLogin', [AdminLoginController::class, 'index'])->name('adminLogin');
Route::post('/adminLogin', [AdminLoginController::class, 'store']);

//USER
//Required auth
Auth::routes();

//Faculty
Route::get('/addfaculty', [FacultyController::class, 'index'])->name('addFaculty');
Route::post('/addfaculty', [FacultyController::class, 'store']);

//Programme
Route::get('/addprogramme', [ProgrammeController::class, 'index'])->name('addProgramme');
Route::post('/addprogramme', [ProgrammeController::class, 'store']);

//Order
Route::get('/order', [OrderController::class, 'index'])->name('Order');
Route::post('/order', [OrderController::class, 'addCart'])->name('AddCart');

//User Information
Route::get('/editUser', [UsersController::class, 'edit'])->name('editUser');
Route::post('/editName', [UsersController::class, 'editName'])->name('editName');
Route::post('/editEmail', [UsersController::class, 'editEmail'])->name('editEmail');
Route::post('/editPassword', [UsersController::class, 'editPassword'])->name('editPassword');
Route::post('/editPhoneNo', [UsersController::class, 'editPhoneNo'])->name('editPhoneNo');
Route::post('/editProgrammeID', [UsersController::class, 'editProgrammeID'])->name('editProgrammeID');
Route::get('/deleteAccount', [UsersController::class, 'deleteAccount'])->name('deleteAccount');
Route::post('/deleteAccount', [UsersController::class, 'deletedAccount'])->name('deletedAccount');

//Home Page
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index']);

//ADMIN
//Report
Route::get('/123', function () {
    return view('report.report');
});
Route::post('/generateDaily', [ReportController::class, 'generateDaily'])->name('generateDaily');
Route::post('/generateMonthly', [ReportController::class, 'generateMonthly'])->name('generateMonthly');
Route::post('/generateYearly', [ReportController::class, 'generateYearly'])->name('generateYearly');

//User Dashboard
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
