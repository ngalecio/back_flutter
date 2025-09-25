<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
   // return 'Hola mundo desde laravel';
      return view('holamundo');
});

Route::get('/resultado', function () {
    return view('resultado');
});

Route::get('/resultado/{numero_orden}/{clave}', function ($numero_orden, $clave) {
    return view('resultado', [
        'numero_orden' => $numero_orden,
        'clave' => $clave
    ]);
});
