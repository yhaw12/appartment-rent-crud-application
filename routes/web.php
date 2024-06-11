<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\FinancesController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\tennantController;
use App\Http\Controllers\tennantsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
// use Illuminate\Auth\Events\Login;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// GET METHODS


 Route::get('/', [DashboardController::class, 'dashboard'])->middleware('auth');
 Route::get('/register', [UserController::class, 'create'])->middleware('guest');
 Route::get('/login',[UserController::class, 'login'])->name('login')->middleware('guest');
 Route::get('/dashboard',[DashboardController::class, 'dashboard'])->middleware('auth');
 Route::get('/house/a',[HouseController::class, 'houseA'])->middleware('auth');
 Route::get('/house/b',[HouseController::class, 'houseB'])->middleware('auth');
 Route::get('/house/c',[HouseController::class, 'houseC'])->middleware('auth');
 Route::get('/house/stores',[HouseController::class, 'houseS'])->middleware('auth');
 Route::get('/tennants',[tennantController::class, 'tennants'])->middleware('auth');
 Route::get('/tenant/{house}/{number}', [HouseController::class, 'getTenant'])->middleware('auth');
 Route::get('/finances', [FinancesController::class, 'getFinancialData'])->middleware('auth');

 Route::get('/notifications/count', [NotificationController::class, 'count']);

 Route::get('/send-test-email', function () {
    Mail::to('elvisobeng51@gmail.com')->send(new TestMail());
    return 'Test email sent!  ddddddddddddddddddddddddd';
});






// POST METHODS
Route::post('/users', [UserController::class, 'store']);
Route::post('/user',[UserController::class, 'show']);
Route::post('/logout',[UserController::class, 'logout'])->middleware('auth');
Route::post('/tennant',[tennantController::class, 'store'])->name('tennant.store');
Route::get('/export', [tennantController::class, 'export'])->name('export.tenants');


// EDIT METHODS
Route::put('tennant/update/{id}', [tennantController::class, 'update'])->name('tennant.update');


// DELETE METHODS
Route::delete('/tennant/{id}', [tennantController::class, 'destroy'])->name('tennant.destroy');



