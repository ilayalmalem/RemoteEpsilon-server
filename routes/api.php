<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::middleware('auth:api')->group(function () {
    Route::get('assignments', 'AssignmentController@index');
    Route::get('/assignment/{id}', 'AssignmentController@show');
    Route::get('/{user}/assignments', 'AssignmentController@ofUser');
    Route::get('/assignments/all', 'AssignmentController@all');
    Route::get('/assignments/overdue', 'AssignmentController@overdue');

    Route::post('/assignments/create', 'AssignmentController@create');
});