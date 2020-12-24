<?php

use App\Http\Controllers\FinanceController;
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

Route::view('/', 'welcome')->name('welcome');

Route::middleware('auth', 'verified')->group(function () {
	Route::view('dashboard', 'dashboard')->name('dashboard');
	Route::view('profile', 'profile')->name('profile');
	Route::view('finance', 'finance.finance')->name('finance');
	Route::view('expanse', 'expanse.expanse')->name('expanse');

	Route::prefix('api')
		->group(function () {
			Route::get('finance', [FinanceController::class, 'index'])->name('finance.all');
		});
});
