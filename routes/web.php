<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\UserController;
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
//Auth Routes
Route::get('/', [StaticController::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store']);

//Resources
Route::resource('users', UserController::class);
Route::group(['middleware' => ['auth']], function() {
  Route::resource('budgets', BudgetController::class);
  Route::resource('incomes', IncomeController::class);
  Route::resource('expenses', ExpenseController::class);
  Route::resource('stats', StatController::class); 
  
  //MISC
  Route::resource('reports', ReportController::class);
  Route::get('/export', [ReportController::class, 'show']);
});

