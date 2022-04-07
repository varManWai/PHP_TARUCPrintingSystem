<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\SubjectController;

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

//Subject
Route::get('/addsubject',[SubjectController::class, 'index']) -> name('addSubject');
Route::post('/addsubject',[SubjectController::class,'store']);

//Order
Route::get('/order', [OrderController::class, 'index'])->name('Order');
Route::post('/order', [OrderController::class, 'addCart'])->name('AddCart');

//Cart
Route::get('/cart', [OrderController::class, 'cartIndex'])->name('Cart');
Route::post('/cartAdd',[OrderController::class,'addCartFromCart'])->name('addCartFromCart');
Route::post('/cartReduce',[OrderController::class,'reduceCart'])->name('reduceCart');
Route::post('/cartRemove', [OrderController::class, 'removeFromCart'])->name('removeCart');

//User Information
Route::get('/editUser', [UsersController::class, 'edit'])->name('editUser');
Route::post('/editName', [UsersController::class, 'editName'])->name('editName');
Route::post('/editEmail', [UsersController::class, 'editEmail'])->name('editEmail');
Route::post('/editPassword', [UsersController::class, 'editPassword'])->name('editPassword');
Route::post('/editPhoneNo', [UsersController::class, 'editPhoneNo'])->name('editPhoneNo');
Route::post('/editProgrammeID', [UsersController::class, 'editProgrammeID'])->name('editProgrammeID');
Route::get('/deleteAccount', [UsersController::class, 'deleteAccount'])->name('deleteAccount');
Route::post('/deleteAccount', [UsersController::class, 'deletedAccount'])->name('deletedAccount');

//OrderHistory
Route::get('/orderHistory', [OrderHistoryController::class, 'index'])->name('orderHistory');

//Home Page
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index']);

//ADMIN
//Report
Route::get('/123', function () {
    return view('report.report');
});

Route::get('/generateDaily', [ReportController::class, 'generateDaily'])->name('generateDaily');
Route::get('/generateMonthly', [ReportController::class, 'generateMonthly'])->name('generateMonthly');
Route::get('/generateYearly', [ReportController::class, 'generateYearly'])->name('generateYearly');
Route::post('/generateDaily', [ReportController::class, 'generateDaily'])->name('generateDaily');
Route::post('/generateMonthly', [ReportController::class, 'generateMonthly'])->name('generateMonthly');
Route::post('/generateYearly', [ReportController::class, 'generateYearly'])->name('generateYearly');

//User Dashboard
Route::get('/usersDashboard', [AdminController::class, 'index'])->name('usersDashboard');
Route::get('/editUserAccount/{id}', [AdminController::class, 'editUser'])->name('editUserAccount');
Route::get('/deleteUserAccount/{id}', [AdminController::class, 'deleteUser'])->name('deleteUserAccount');
Route::post('/editUserName', [AdminController::class, 'editUserName'])->name('editUserName');
Route::post('/editUserEmail', [AdminController::class, 'editUserEmail'])->name('editUserEmail');
Route::post('/editUserPassword', [AdminController::class, 'editUserPassword'])->name('editUserPassword');
Route::post('/editUserPhoneNo', [AdminController::class, 'editUserPhoneNo'])->name('editUserPhoneNo');
Route::post('/editUserProgrammeID', [AdminController::class, 'editUserProgrammeID'])->name('editUserProgrammeID');


Route::get('/suppliersDashboard', [AdminController::class, 'index'])->name('suppliersDashboard');
Route::get('/addSupplierAccount', [AdminController::class, 'index'])->name('addSupplierAccount');
// Route::get('/editSupplierAccount/{id}', [AdminController::class, 'index'])->name('editSupplierAccount');
// Route::get('/deleteSupplierAccoun/{id}', [AdminController::class, 'index'])->name('deleteSupplierAccount');
