<?php

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




Route::get('/', 'VendingMachineController@index');

// @request->code
Route::post('selectdrink', 'VendingMachineController@selectDrink');
// @request->amount
Route::post('insertmoney', 'VendingMachineController@insertMoney');
