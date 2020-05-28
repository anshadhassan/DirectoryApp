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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/update-page', 'HomeController@updateFiles');
Route::get('/delete-file/{file}', 'HomeController@deleteFile');
Route::POST('/upload-file', 'HomeController@uploadFilePost')->name('file.upload.post');
Route::get('/upload-file', 'HomeController@uploadFile')->name('file.upload');

