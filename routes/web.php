<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
Route::get('/', function () {
    return '✅ Inventario-IDP está corriendo. Ruta / activa.';
});
Route::get('/ping', fn() => '✅ Laravel responde sin Blade');
Route::get('/vista-test', fn() => view('vista-test'));
