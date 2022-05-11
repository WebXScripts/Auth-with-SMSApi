<?php

use App\Http\Controllers\SMSAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('two-factor-auth', [SMSAuthController::class, 'index'])->name('2fa.index');
Route::post('two-factor-auth', [SMSAuthController::class, 'store'])->name('2fa.store');
Route::get('two-factor-auth/resent', [SMSAuthController::class, 'resend'])->name('2fa.resend');
