<?php

use App\Http\Controllers\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/saludo', function () {
    return response()->json(["mensaje" => "Hola es un proyecto Backend API"], 200);
});


//Rutas de autenticacion

Route::prefix('v1/auth')->group(function () {
    Route::post("login", [ApiAuthController::class, "funLogin"]);
    Route::post("register", [ApiAuthController::class, "funRegister"]);
    Route::post("listar", [ApiAuthController::class, "funlistar"]);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get("profile", [ApiAuthController::class, "funProfile"]);
        Route::post("logout", [ApiAuthController::class, "funLogout"]);
    });
});
