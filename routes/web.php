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

/* add route for create Comapny */
Route::get('/' , 'CompanyController@index')->name('home');

/* store company */
Route::post('/store_company' , 'CompanyController@store')->name('store_company');

/* get data from rapid api and view the graphs */
Route::get('/get_graph','GraphConroller@index')->name('graph_view');