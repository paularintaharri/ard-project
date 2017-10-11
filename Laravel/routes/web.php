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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/documentation/api', function () {
    return view('api_doc');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::Resource('tickets', 'TicketController')->middleware('auth');

Route::get('/home/mytickets', 'HomeController@userTickets');
