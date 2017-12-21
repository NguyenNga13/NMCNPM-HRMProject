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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Api\Auth\LoginController@login');
Route::post('refresh', 'Api\Auth\LoginController@refresh');
// Route::post('logout', 'Api\Auth\LoginController@logout');


Route::middleware('auth:api')->group(function(){
    Route::get('logout', 'Api\Auth\LoginController@logout');

    Route::get('profile', 'Api\EmployeeController@profile');
    Route::get('summary', 'Api\EmployeeController@summary');
    Route::get('position', 'Api\EmployeeController@position');
    // Route::get('position_list', 'Api\EmployeeController@positionList');
    Route::get('relatives', 'Api\EmployeeController@relatives');
    Route::get('degree', 'Api\EmployeeController@degree');

    Route::get('salary', 'Api\EmployeeController@salary');

});
