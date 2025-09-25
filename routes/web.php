<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('inicio');
});

Route::get('/servicios', function () {
    return view('servicios');
});

Route::get('/nosotros', function () {
    return view('nosotros');
});

Route::get('/welcome', function () {
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
