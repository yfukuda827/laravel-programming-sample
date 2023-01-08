<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TraceLog;

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

Route::middleware([TraceLog::class])->group(function() {
    Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('login/admin', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm']);
    Route::post('login/admin', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin']);

    Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'show']);
    Route::post('register/confirm', [App\Http\Controllers\Auth\RegisterController::class, 'confirm']);
    Route::post('register/complete', [App\Http\Controllers\Auth\RegisterController::class, 'complete']);

    Route::get('order/{product}', [App\Http\Controllers\OrderController::class, 'show']);
    Route::post('order/confirm', [\App\Http\Controllers\OrderController::class, 'confirm']);
    Route::post('order/complete', [\App\Http\Controllers\OrderController::class, 'complete']);

    Route::view('terms', 'pages.terms');
});

Route::middleware([TraceLog::class, 'auth:web'])->prefix('mypage')->group(function() {
    Route::get('', [App\Http\Controllers\UserController::class, 'mypage']);
    Route::get('edit_password', [\App\Http\Controllers\UserController::class, 'showEditPassword']);
    Route::post('edit_password/confirm', [\App\Http\Controllers\UserController::class, 'confirmEditPassword']);
    Route::post('edit_password/complete', [\App\Http\Controllers\UserController::class, 'completeEditPassword']);
}); 

Route::middleware([TraceLog::class, 'auth:admin'])->prefix('admin')->group(function() {
    Route::get('/dashboard', [App\Http\Controllers\OrderController::class, 'adminIndex']);
}); 
