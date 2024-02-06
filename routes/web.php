<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Auth\Events\Login;

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
 Route::get('/', [LayoutController::class, 'home']);
 Route::get('/register', [RegisterController::class, 'create']);
 Route::get('/login', [LoginController::class, 'login']);

// POST METHODS
Route::post('/users', [RegisterController::class, 'store']);
Route::post('/user', [LoginController::class, 'show']);
