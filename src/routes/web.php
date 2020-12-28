<?php

use App\Http\Controllers\ExpanseController;
use App\Http\Controllers\IncomeController;
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

	Route::resource('income', IncomeController::class);
	Route::resource('expanse', ExpanseController::class);


	Route::prefix('api')
		->group(function(){
			Route::get('get-income' , [IncomeController::class , 'getIncome'])->name('income-ajx');
			Route::get('get-expanse' , [ExpanseController::class , 'getExpanseData'])->name('get-expanse-data');
		});
});
