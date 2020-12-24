<?php

use App\Http\Controllers\ExpanseController;
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

	Route::prefix('finance')
		->group(function () {
			Route::get('/', [FinanceController::class, 'index'])->name('finance');
		});

	Route::prefix('expanse')
		->group(function () {
			Route::get('/', [ExpanseController::class, 'index'])->name('expanse');
		});
});
