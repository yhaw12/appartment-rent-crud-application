<?php

use App\Http\Controllers\AppartmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayoutController;
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
 Route::get('/register', [UserController::class, 'create']);
 Route::get('/login',[UserController::class, 'login']);
 Route::get('dashboard',[DashboardController::class, 'dashboard']);
 Route::get('/appartment/a',[AppartmentController::class, 'appartment']);
 Route::get('/appartment/b',[AppartmentController::class, 'appartment']);
 Route::get('/appartment/c',[AppartmentController::class, 'appartment']);



// POST METHODS
Route::post('/users', [UserController::class, 'store']);
Route::post('/user',[UserController::class, 'show']);
