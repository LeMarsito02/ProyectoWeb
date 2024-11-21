<?php

use App\Http\Controllers\menuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu', function (){return view('menu');
})->name('menu');

Route::get('/index', function () {
    return view('welcome');
})->name('index');

Route::get('/contacto', function () {
    return view('contacto');
})->name(name: 'contacto');

Route::get('api/menu-items', [MenuController::class, 'index']);
Route::post('/orders', [menuController::class, 'store']);