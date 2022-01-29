<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ToDoController;
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
    return view('login');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register ', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login ', [LoginController::class, 'store'])->middleware('guest');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout')->middleware('auth');

Route::get('/todo', [ToDoController::class, 'index'])->name('todos')->middleware('auth');
Route::post('/todo', [ToDoController::class, 'store'])->middleware('auth');

Route::get('/todo/{todo:id}/edit', [ToDoController::class, 'edit'])->name('todos.edit')->middleware('auth');
Route::post('/todo/{id}/update', [ToDoController::class, 'update'])->name('todos.update')->middleware('auth');
Route::post('/todo/{id}/complete', [ToDoController::class, 'toggleCompletion'])->name('todos.complete')->middleware('auth');

Route::post('/todo/{todo:id}/delete', [ToDoController::class, 'destroy'])->name('todos.remove')->middleware('auth');

Route::get('/search', [ToDoController::class, 'search'])->name('search')->middleware('auth');
Route::post('/search', [ToDoController::class, 'search'])->middleware('auth');
