<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\ScheduleController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/create', [ConditionController::class, 'create']);
Route::post('/delete', [ConditionController::class, 'delete']);
Route::get('/list', [ConditionController::class, 'list']);
Route::post('/month', [ConditionController::class, 'month']);

Route::post('/schedule/create', [ScheduleController::class, 'create']);
Route::post('/schedule/delete', [ScheduleController::class, 'delete']);
Route::get('/schedule/get', [ScheduleController::class, 'get']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->where('any', '.*');
