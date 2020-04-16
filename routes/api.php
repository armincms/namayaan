<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/', 'SchemaController@handle');
Route::get('/home', 'HomeController@index');
Route::get('/filter', 'FilterController@index');
Route::get('/genre', 'GenreController@index');
Route::get('/tag', 'TagController@index');
