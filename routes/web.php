<?php


use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::post('/image', 'PhotoController@uploadImage');
Route::post('/image/25', 'PhotoController@huszonot');
Route::post('/image/meretez', 'PhotoController@meretez');
Route::post('/image/JPG', 'PhotoController@jpg');
Route::get('/image/download', 'PhotoController@download');


Route::get('/', function () {

    return view('photo');
});



