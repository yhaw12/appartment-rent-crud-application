<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\tennantController;
use App\Http\Controllers\tennantsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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


 Route::get('/', [DashboardController::class, 'dashboard']);
 Route::get('/register', [UserController::class, 'create'])->middleware('guest');
 Route::get('/login',[UserController::class, 'login'])->name('login')->middleware('guest');
 Route::get('dashboard',[DashboardController::class, 'dashboard'])->middleware('auth');
 Route::get('/house/a',[HouseController::class, 'house'])->middleware('auth');
 Route::get('/house/b',[HouseController::class, 'house'])->middleware('auth');
 Route::get('/house/c',[HouseController::class, 'house'])->middleware('auth');
 Route::get('/tennants',[tennantController::class, 'tennants'])->middleware('auth');




// POST METHODS
Route::post('/users', [UserController::class, 'store']);
Route::post('/user',[UserController::class, 'show']);
Route::post('/logout',[UserController::class, 'logout'])->middleware('auth');
Route::post('/tennant',[tennantController::class, 'store'])->name('tennant.store');



