<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard/total-occupied', [DashboardController::class, 'getTotalOccupied']);
Route::get('/dashboard/total-empty', [DashboardController::class, 'getTotalEmpty']);
Route::get('/dashboard/total-renting-soon', [DashboardController::class, 'getTotalRentingSoon']);