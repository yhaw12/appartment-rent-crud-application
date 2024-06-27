<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\FinancesController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\tennantController;
use App\Http\Controllers\tennantsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
// use Illuminate\Notifications\Notification;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\TestEmail;

// use App\Http\Controllers\NotificationController;

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
 Route::get('/house/a',[houseController::class, 'houseA'])->middleware('auth');
 Route::get('/house/b',[houseController::class, 'houseB'])->middleware('auth');
 Route::get('/house/c',[houseController::class, 'houseC'])->middleware('auth');
 Route::get('/house/stores',[houseController::class, 'houseS'])->middleware('auth');
 Route::get('/tennants',[tennantController::class, 'tennants'])->middleware('auth');
 Route::get('/tenant/{house}/{number}', [houseController::class, 'getTenant'])->middleware('auth');
 Route::get('/finances', [FinancesController::class, 'getFinancialData'])->middleware('auth');
 Route::get('/occupancy-rate', [ReportsController::class, 'occupancyRate'])->name('occupancy-rate')->middleware('auth');
 Route::get('/dashboard/{cardName}', [DashboardController::class, 'getCardDetails'])->middleware('auth');


// POST METHODS
Route::post('/users', [UserController::class, 'store']);
Route::post('/user',[UserController::class, 'show']);
Route::post('/logout',[UserController::class, 'logout'])->middleware('auth');
Route::post('/tennant',[tennantController::class, 'store'])->name('tennant.store');
// Route::post('/user', [UserController::class, 'show'])->middleware('block.ip');
// Route::post('/login', [UserController::class, 'show'])->middleware('block.ip');
Route::get('/export', [tennantController::class, 'export'])->name('export.tenants');



// EDIT METHODS
Route::put('tennant/update/{id}', [tennantController::class, 'update'])->name('tennant.update');


// DELETE METHODS
Route::delete('/tennant/{id}', [tennantController::class, 'destroy'])->name('tennant.destroy');



// NOTIFICATIONS
Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('notifications.get');
Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');



// Route::get('/send-test-email', function () {
//     Mail::to('yawoben21@gmail.com')->send(new TestEmail());
//     return 'Test email sent!';
// });

// Route::get('/test', function () {
//     return 'Test route works!';
// });