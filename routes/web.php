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

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard', ['as' => 'dashboard',  'uses' => 'HolidayController@index']);

    Route::get('/year', ['as' => 'year',  'uses' => 'HolidayController@getYear']);
    Route::post('/year', ['as' => 'create',  'uses' => 'HolidayController@fetch']); 
    Route::get('/hoiday/pdf', ['as' => 'holidays',  'uses' => 'HolidayController@createPDF']); 
    
});