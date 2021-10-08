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
// Storage
Route::prefix('/storage')->group(function(){
	Route::get('/viewmini','ViewController@view_ministorage');
	Route::get('get/mini','StorageController@getlistmini');
	Route::post('create/mini','StorageController@createmini');
});

Route::post('/product','StorageController@post');
Route::put('/product/{id}','StorageController@put');
Route::delete('/product/{id}','StorageController@delete');