<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rutas libres, para la autenticación
Route::prefix('auth')->group(function () {

    Route::post('register', 'Auth\Jwt\RegisterController@register');
    Route::post('login', 'Auth\Jwt\LoginController@login');
    Route::post('logout', 'Auth\Jwt\LoginController@logout');

    Route::post('recovery', 'Auth\Jwt\ForgotPasswordController@sendResetEmail');
    Route::post('reset', 'Auth\Jwt\ResetPasswordController@reset');

});

// Rutas protegidas
Route::middleware(['jwt.auth'])->group(function () {

    Route::get('/', function () {
        return response()->json([
                'message' => 'Acceso a los recursos protegidos! Está viendo este texto cuando proporcionó el token correctamente.'
            ]);
    });

    Route::get('/user', function () {
        $user = Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
        return $user;
    });

});