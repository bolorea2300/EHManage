<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;

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
    return view('index');
});

Auth::routes();

Route::post('/create', [ConditionController::class, 'create'])->middleware('auth');
Route::post('/delete', [ConditionController::class, 'delete'])->middleware('auth');
Route::get('/list', [ConditionController::class, 'list'])->middleware('auth');
Route::post('/month', [ConditionController::class, 'month'])->middleware('auth');
Route::post('/year', [ConditionController::class, 'year'])->middleware('auth');

Route::post('/schedule/create', [ScheduleController::class, 'create'])->middleware('auth');
Route::post('/schedule/delete', [ScheduleController::class, 'delete'])->middleware('auth');
Route::get('/schedule/get', [ScheduleController::class, 'get'])->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->where('any', '.*');
Route::get('/image/{id}', [ImageController::class, 'image']);
Route::post('/password', [UserController::class, 'password'])->middleware('auth');
