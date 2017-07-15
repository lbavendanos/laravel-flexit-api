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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('auth')->group(function () {
    Route::post('register', 'Auth\Jwt\RegisterController@register');
    Route::post('login', 'Auth\Jwt\LoginController@login');
    Route::post('logout', 'Auth\Jwt\LoginController@logout');

    Route::post('recovery', 'Auth\Jwt\ForgotPasswordController@sendResetEmail');
    Route::post('reset', 'Auth\Jwt\ResetPasswordController@reset');
});