<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register' => false]);

Route::get('/', 'PageController@index');
Route::post('/subscribe', 'PageController@subscribe');
Route::get('/about', 'PageController@about');
Route::get('/coachings', 'PageController@coachings');
Route::get('/teachers', 'PageController@teachers');
Route::get('/registercoaching', 'PageController@coachingRegister');
Route::get('/registerteacher', 'PageController@teacherRegister');
Route::post('/addcoachinguser', 'PageController@addCoachingUser');
Route::post('/addteacheruser', 'PageController@addTeacherUser');
Route::get('/contact', 'PageController@contact');
Route::post('/sendquery', 'PageController@sendQuery');



Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/subscription', 'HomeController@subscription');
    Route::get('/enquiry', 'HomeController@enquiry');
    Route::get('/event', 'HomeController@event');
    Route::get('/addeventpage', 'HomeController@addEventPage');
    Route::post('/addevent', 'HomeController@addEvent');

    Route::get('/teacher-page', 'HomeController@teacherPage');
    Route::get('/coaching-page', 'HomeController@coachingPage');

    Route::get('/featured-teacher-page', 'HomeController@featuredTeacherPage');
    Route::get('/featured-coaching-page', 'HomeController@featuredCoachingPage');

    Route::get('/teacher-request', 'HomeController@teacherRequestPage');
    Route::get('/coaching-request', 'HomeController@coachingRequestPage');

    Route::get('/addteacherpage', 'HomeController@addTeacherPage');
    Route::get('/addcoachingpage', 'HomeController@addCoachingPage');

    Route::post('/addteacher', 'HomeController@addTeacher');
    Route::post('/addcoaching', 'HomeController@addCoaching');

    Route::get('/teacher-edit/{id}', 'HomeController@editTeacherPage');
    Route::get('/coaching-edit/{id}', 'HomeController@editCoachingPage');

    Route::put('/teacher-update/{id}', 'HomeController@updateTeacher');
    Route::put('/coaching-update/{id}', 'HomeController@updateCoaching');

    Route::delete('/teacher-delete/{id}', 'HomeController@deleteTeacher');
    Route::delete('/coaching-delete/{id}', 'HomeController@deleteCoaching');

    Route::put('/teacher-feature/{id}', 'HomeController@featureTeacher');
    Route::put('/coaching-feature/{id}', 'HomeController@featureCoaching');

    Route::put('/teacher-accept/{id}', 'HomeController@acceptTeacher');
    Route::put('/coaching-accept/{id}', 'HomeController@acceptCoaching');

    Route::put('/teacher-unfeature/{id}', 'HomeController@unfeatureTeacher');
    Route::put('/coaching-unfeature/{id}', 'HomeController@unfeatureCoaching');
});
