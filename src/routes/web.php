<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BreaktimeController;


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


Fortify::verifyEmailView(function () {
  return view('auth.verify-email');
});
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();
  return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();
  return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

//   // 自動退勤・出勤のルート（スケジュールタスクで実行）
//   Route::get('/auto-checkout-checkin', [AttendanceController::class, 'autoCheckoutAndCheckin'])->name('auto.checkout.checkin');

// // ヘルスチェックエンドポイントの設定
// Route::get('/healthz', function () {
//   return response()->json(['status' => 'ok'], 200);
// });

Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/', [AttendanceController::class, 'index']);
  Route::post('/checkin', [AttendanceController::class, 'checkIn']);
  Route::post('/checkout', [AttendanceController::class, 'checkOut']);
  Route::post('/breakstart', [BreaktimeController::class, 'breakStart']);
  Route::post('/breakend', [BreaktimeController::class, 'breakEnd']);
  Route::get('/attendance', [AttendanceController::class, 'attendance'])->name('attendance');
  Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
  Route::get('/users', [AttendanceController::class, 'userIndex'])->name('users');
  Route::get('/users/{user}', [AttendanceController::class, 'userShow'])->name('show');

  // Route::get('/register', [RegisteredUserController::class, 'create']);
  // Route::post('/register', [RegisteredUserController::class, 'store']);
  // Route::get('/login', [AuthenticatedSessionController::class, 'store']);
  // Route::post('/login', [AuthenticatedSessionController::class, 'store']);
  // Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
});