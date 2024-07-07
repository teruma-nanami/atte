<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BreaktimeController;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\RegisteredUserController;
// use App\Http\Controllers\AuthenticatedSessionController;
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


// Fortify::verifyEmailView(function () {
//   return view('auth.verify-email');
// });

Route::middleware(['auth'])->group(function () {
  Route::get('/', [AttendanceController::class, 'index']);
  Route::post('/checkin', [AttendanceController::class, 'checkin']);
  Route::post('/checkout', [AttendanceController::class, 'checkout']);
  Route::post('/breakstart', [BreaktimeController::class, 'breakstart']);
  Route::post('/breakend', [BreaktimeController::class, 'breakend']);
  Route::get('/attendance', [AttendanceController::class, 'attendance'])->name('attendance');
  Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
  // Route::get('/register', [RegisteredUserController::class, 'create']);
  // Route::post('/register', [RegisteredUserController::class, 'store']);
  // Route::get('/login', [AuthenticatedSessionController::class, 'store']);
  // Route::post('/login', [AuthenticatedSessionController::class, 'store']);
  // Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
});