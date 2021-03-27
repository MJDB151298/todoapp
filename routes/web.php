<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Routes for tasks



//Routes for categories
Route::apiResource('/tasks', \App\Http\Controllers\TaskController::class);
Route::get('/tasks/filter/{category_id}', [\App\Http\Controllers\TaskController::class, 'showByFilters']);


Route::apiResource('/categories', \App\Http\Controllers\CategoryController::class);
Route::get('/categories/name/{name}', [\App\Http\Controllers\CategoryController::class, 'showByName']);

