<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SupplierLoginController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SupplierController;
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

//SUPPLIER
Route::get('/supplierLogin', [SupplierLoginController::class, 'index'])->name('supplierLogin');
Route::post('/supplierLogin', [SupplierLoginController::class, 'store'])->name('supplierLogin');



//USER
//Required auth
Auth::routes();

//Faculty
Route::get('/addfaculty', [FacultyController::class, 'index'])->name('addFaculty');
Route::post('/addfaculty', [FacultyController::class, 'store']);
Route::get('/facultydashboard', [FacultyController::class, 'retrieve'])->name('facultydashboard');

//Programme
Route::get('/addprogramme', [ProgrammeController::class, 'index'])->name('addProgramme');
Route::post('/addprogramme', [ProgrammeController::class, 'store']);
Route::get('/programmedashboard', [ProgrammeController::class, 'retrieve'])->name('programmedashboard');

//Subject
Route::get('/addsubject',[SubjectController::class, 'index']) -> name('addSubject');
Route::post('/addsubject',[SubjectController::class,'store']);
Route::get('/subjectdashboard', [SubjectController::class, 'retrieve'])->name('subjectdashboard');
Route::get("/xmlSubject", [SubjectController::class,'viewInXml']);

//Order
Route::get('/order', [OrderController::class, 'index'])->name('Order');
Route::post('/order', [OrderController::class, 'addCart'])->name('AddCart');

//Cart
Route::get('/cart', [OrderController::class, 'cartIndex'])->name('Cart');
Route::post('/cartAdd', [OrderController::class, 'addCartFromCart'])->name('addCartFromCart');
Route::post('/cartReduce', [OrderController::class, 'reduceCart'])->name('reduceCart');
Route::post('/cartRemove', [OrderController::class, 'removeFromCart'])->name('removeCart');

//Payment
route::post('/payment', [OrderController::class, 'createOrder'])->name('createOrder');
route::get('/test', [OrderController::class, 'test']);

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
Route::get("/xmlOrderHistory", [OrderHistoryController::class,'loadXML']);

//Home Page
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index']);

//ADMIN
//Report
Route::group(['middleware' => ['web','auth:admin'], 'prefix' => 'admins'], function () {
    Route::get('/123', function () {
        return view('report.report');
    });



Route::get('/generateDaily', [ReportController::class, 'generateDaily'])->name('generateDaily');
Route::get('/generateMonthly', [ReportController::class, 'generateMonthly'])->name('generateMonthly');
Route::get('/generateYearly', [ReportController::class, 'generateYearly'])->name('generateYearly');
Route::post('/generateDaily', [ReportController::class, 'generateDaily'])->name('generateDaily');
Route::post('/generateMonthly', [ReportController::class, 'generateMonthly'])->name('generateMonthly');
Route::post('/generateYearly', [ReportController::class, 'generateYearly'])->name('generateYearly');

//User Acc Dashboard
    Route::get('/usersDashboard', [AdminController::class, 'index'])->name('usersDashboard');
    Route::get('/editUserAccount/{id}', [AdminController::class, 'editUser'])->name('editUserAccount');
    Route::get('/deleteUserAccount/{id}', [AdminController::class, 'deleteUser'])->name('deleteUserAccount');
    Route::post('/editUserName', [AdminController::class, 'editUserName'])->name('editUserName');
    Route::post('/editUserEmail', [AdminController::class, 'editUserEmail'])->name('editUserEmail');
    Route::post('/editUserPassword', [AdminController::class, 'editUserPassword'])->name('editUserPassword');
    Route::post('/editUserPhoneNo', [AdminController::class, 'editUserPhoneNo'])->name('editUserPhoneNo');
    Route::post('/editUserProgrammeID', [AdminController::class, 'editUserProgrammeID'])->name('editUserProgrammeID');

//Supplier Acc Dashboard
    Route::get('/suppliersDashboard', [AdminController::class, 'supplierDashboard'])->name('suppliersDashboard');
    Route::get('/addSupplierAccount', [AdminController::class, 'addSupplier'])->name('addSupplierAccount');
    Route::post('/addSupplierAccount', [AdminController::class, 'addedSupplier'])->name('addedSupplierAccount');
    Route::get('/editSupplierAccount/{id}', [AdminController::class, 'editSupplier'])->name('editSupplierAccount');
    Route::get('/deleteSupplierAccount/{id}', [AdminController::class, 'deleteSupplier'])->name('deleteSupplierAccount');
    Route::post('/editSupplierName', [AdminController::class, 'editSupplierName'])->name('editSupplierName');
    Route::post('/editSupplierEmail', [AdminController::class, 'editSupplierEmail'])->name('editSupplierEmail');
    Route::post('/editSupplierPassword', [AdminController::class, 'editSupplierPassword'])->name('editSupplierPassword');
    Route::post('/editSupplierPhoneNo', [AdminController::class, 'editSupplierPhoneNo'])->name('editSupplierPhoneNo');
    Route::post('/editSupplierShopName', [AdminController::class, 'editSupplierShopName'])->name('editSupplierShopName');
    Route::post('/editSupplierLocation', [AdminController::class, 'editSupplierLocation'])->name('editSupplierLocation');

//Supplier Acc Dashboard
    Route::get('/adminDashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('/addAdminAccount', [AdminController::class, 'addAdmin'])->name('addAdminAccount');
    Route::post('/addAdminAccount', [AdminController::class, 'addedAdmin'])->name('addedAdminAccount');
    Route::get('/editAdminAccount/{id}', [AdminController::class, 'editAdmin'])->name('editAdminAccount');
    Route::get('/deleteAdminAccount/{id}', [AdminController::class, 'deleteAdmin'])->name('deleteAdminAccount');
    Route::post('/editAdminName', [AdminController::class, 'editAdminName'])->name('editAdminName');
    Route::post('/editAdminEmail', [AdminController::class, 'editAdminEmail'])->name('editAdminEmail');
    Route::post('/editAdminPassword', [AdminController::class, 'editAdminPassword'])->name('editAdminPassword');
    Route::post('/editAdminPhoneNo', [AdminController::class, 'editAdminPhoneNo'])->name('editAdminPhoneNo');
    Route::post('/adminLogout', [AdminController::class, 'adminLogout'])->name('adminLogout');
});

Route::group(['middleware' => ['web','auth:supplier'], 'prefix' => 'suppliers'], function () {
    Route::get('/orderStatusDashboard', [SupplierController::class, 'orderStatusDashboard'])->name('orderStatusDashboard');
    Route::get('/editOrderStatus/{id}', [SupplierController::class, 'editOrderStatus'])->name('editOrderStatus');
    Route::post('/editedOrderStatus', [SupplierController::class, 'editedOrderStatus'])->name('editedOrderStatus');
    Route::post('/supplierLogout', [SupplierController::class, 'supplierLogout'])->name('supplierLogout');
});