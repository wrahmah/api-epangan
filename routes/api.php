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
	Route::get('viewmini','ViewController@view_ministorage');
	Route::post('viewcold','StorageController@view_coldstorage');
	Route::get('get/{id}','StorageController@getliststorage');
	Route::post('create','StorageController@create');
	
});

Route::prefix('/petani')->group(function(){
	Route::get('get/{id}', 'PetaniController@getdata');
	Route::get('getpetani','PetaniController@getpetani');
	Route::get('form','ViewController@form_petani');
	Route::post('create','PetaniController@create');

});

Route::prefix('/proses')->group(function(){
	Route::get('penerimaan/list','ProsesController@list_receive');
	Route::get('penermaan/get_list','ProsesController@get_listreceive');
	Route::post('receive/formitem/{param?}','JavascriptController@form_item_receive');
	Route::post('create/receive','ProsesController@create_receive');
	Route::get('form/receive','ProsesController@formreceive');
});

Route::post('/product','StorageController@post');
Route::put('/product/{id}','StorageController@put');
Route::delete('/product/{id}','StorageController@delete');