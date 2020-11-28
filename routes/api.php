<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('test', [PatientController::class, 'testapi']);

Route::post('login', [PatientController::class, 'login']);

Route::middleware('auth:api')->group(function (){

});


//Route::prefix('/user')->group(function (){
//    Route::post('/login', 'ApiController@login');
//    Route::middleware('auth:api')->post('/list', 'ApiController@list');
//    Route::middleware('auth:api')->post('/works', 'ApiController@works');
//});
