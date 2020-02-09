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
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'UserController@details');
Route::put('update', 'UserController@update');

});
Route::apiResource('/clients','ClientController');
Route::apiResource('/materials','MaterialController');
Route::apiResource('/receipts','ReceiptController');
Route::apiResource('/cashes','CashController');
Route::apiResource('/activities','ActivityController');
Route::apiResource('/sales','SaleController');
Route::apiResource('/state','StateController');
Route::get('search','StateController@search');
