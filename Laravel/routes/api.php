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

// Get current user
Route::get('/me', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::Resource(
    'tickets', 'TicketController', ['only' => [
    'index', 'show'
]])->middleware('auth:api');

//Get lon and lat coordinates
Route::get('/tickets/{id}/coordinates', 'TicketController@coordinates');

//Get tickets by the city
Route::get('/tickets/ticketsbycity/{city}', 'TicketController@ticketsbycity');
