<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard/login');
});

//ruta para poder entrar del login al dashboard de filament
Route::get('/store', [UserController::class, 'store']); 

