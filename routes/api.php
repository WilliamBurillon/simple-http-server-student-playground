<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware(['verify-student'])->group(function() {
    //Waiting for an header 'pikachu'
    Route::get('/route-1', [Controller::class, 'checkHeader']);

    //Waiting for an array of 'favoritePokemons' in query parameters
    Route::get('/route-2', [Controller::class, 'haveQueryParameterArray']);

    Route::post('/route-3' ,[ Controller::class, 'jsonBody']);
    Route::post('/route-4' ,[ Controller::class, 'multipartForm']);
    Route::post('/route-5' ,[ Controller::class, 'urlEncoded']);

    Route::delete('/route-6' ,[ Controller::class, 'delete']);
    Route::put('/route-7' ,[ Controller::class, 'putForm']);
    Route::patch('/route-8', [Controller::class, 'patchJson']);

});
