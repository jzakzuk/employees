<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/test', [HomeController::class, 'test']);

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware(['auth']);
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware(['auth']);
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware(['auth']);
Route::get('/users/{user}', [UserController::class, 'view'])->name('users.view')->middleware(['auth']);

Route::post('/users/store', [UserController::class, 'store'])->name('users.store')->middleware(['auth']);
Route::post('/users/{user}/update', [UserController::class, 'update'])->name('users.update')->middleware(['auth']);

Route::get('/search-cities/{search?}', [CityController::class, 'search'])->name('cities.search')->middleware(['auth']);

require __DIR__.'/auth.php';
