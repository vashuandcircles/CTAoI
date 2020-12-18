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

//Route::group(['middleware' => ['auth:api']], function () {
    // Get list of meetings.
    Route::get('/meetings', 'Zoom\MeetingController@index')
        ->name('meetings.index');
// Create meeting room using topic, agenda, start_time.
    Route::post('/meetings', 'Zoom\MeetingController@store')
        ->name('meetings.store');
    Route::post('/meetings/create', 'Zoom\MeetingController@create')
        ->name('meetings.create');
// Get information of the meeting room by ID.
    Route::get('/meetings/{id}', 'Zoom\MeetingController@edit')
        ->where('id', '[0-9]+')->name('meetings.edit');
    Route::patch('/meetings/{id}', 'Zoom\MeetingController@update')
        ->where('id', '[0-9]+')->name('meetings.update');
    Route::delete('/meetings/{id}', 'Zoom\MeetingController@destroy')
        ->where('id', '[0-9]+')->name('meetings.destroy');
//});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
