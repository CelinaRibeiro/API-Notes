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

Route::get('/ping', function (Request $request) {
    return ['pong'=>true];
});


Route::get('/notes', 'NoteController@all'); //pesquisa todos

Route::get('/note/{id}', 'NoteController@one'); //pesquisa por id

Route::post('/note', 'NoteController@new'); //insere novo item

Route::put('/note/{id}', 'NoteController@edit'); //atualiza

Route::delete('/note/{id}', 'NoteController@delete'); //deleta
