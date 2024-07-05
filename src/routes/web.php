<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', [TimestampController::class, 'index']);

// Route::get('/', function () {  return view('auth.register');
// });

Route::get('/', [AttendanceController::class, 'index']);
Route::post('/attendance', [AttendanceController::class, 'store']);
Route::get('/attendance', [AttendanceController::class, 'attendance']);

Route::middleware('auth')->group(function () {
  // Route::get('/register', [RegisteredUserController::class, 'create']);
  // Route::post('/register', [RegisteredUserController::class, 'store']);
  // Route::get('/login', [AuthenticatedSessionController::class, 'store']);
  // Route::post('/login', [AuthenticatedSessionController::class, 'store']);
  // Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
});