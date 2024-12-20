<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu', function (){return view('menu');
})->name('menu');


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth:sanctum');
Route::get('/dashboard/pedido/{id}', [DashboardController::class, 'show'])->middleware('auth:sanctum');
Route::put('/dashboard/pedido/{id}/status', [DashboardController::class, 'updateStatus'])
    ->name('updateStatus')
    ->middleware('auth:sanctum');


Route::get('/index', function () {
    return view('welcome');
})->name('index');

Route::get('/contacto', function () {
    return view('contacto');
})->name(name: 'contacto');
