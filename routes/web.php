<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AnnonceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'showIndex'])->name('index');

Route::get('/register', [IndexController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('registerAction');
Route::get('/activate/{token}', [RegisterController::class, 'activate'])->name('activate');

Route::get('/login', [IndexController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('loginAction');

Route::get('/profil/{id}', [UserController::class, 'show'])->name('profil');
Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
Route::put('/edit/{id}', [UserController::class, 'update'])->name('update');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('delete');

Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces.index');
Route::get('/annonces/create', [AnnonceController::class, 'create'])->name('annonces.create');
Route::post('/annonces', [AnnonceController::class, 'store'])->name('annonces.store');
Route::get('/annonces/{annonce}', [AnnonceController::class, 'show'])->name('annonces.show');
Route::get('/annonces/{annonce}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
Route::put('/annonces/{annonce}', [AnnonceController::class, 'update'])->name('annonces.update');
Route::delete('/annonces/{annonce}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');

Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces.index');
