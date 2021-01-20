<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);
Route::get('/', 'PageController@index');
Route::get('/welcome', 'PageController@welcome');
Route::post('/subscribe', 'PageController@subscribe');
Route::get('/search', 'PageController@search');
Route::get('/search/action', 'PageController@action')->name('live_search.action');
Route::get('/about', 'PageController@about');
Route::get('/coachings', 'PageController@coachings');
Route::get('/featuredcoachings', 'PageController@featureCoachings');
Route::get('/teachers', 'PageController@teachers');
Route::get('/students', 'PageController@students');
Route::get('/featuredteachers', 'PagcoachingdashboardeController@featureTeachers');
Route::post('/addcoachinguser', 'PageController@addCoachingUser');
Route::post('/addteacheruser', 'PageController@addTeacherUser');
Route::post('/addstudentuser', 'PageController@addStudentUser');
Route::get('/contact', 'PageController@contact');
Route::post('/sendquery', 'PageController@sendQuery');
Route::get('/coachingpayment', 'PageController@coachingpayment');
Route::get('/teacherpayment', 'PageController@teacherpayment');

Route::get('/coachingdetail/{id}', 'PageController@coachingDetail');
Route::get('/teacherdetail/{id}', 'PageController@teacherDetail');
Route::get('/studentdetail/{id}', 'PageController@studentDetail');


Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::resource('coachings', 'CoachingController');
        Route::resource('teachers', 'TeacherController');
        Route::resource('students', 'StudentController');
        Route::put('feature/{id}', 'CoachingController@feature')->name('coachings.feature');
        Route::put('tfeature/{id}', 'TeacherController@feature')->name('teachers.feature');
    });
    Route::get('/coachingdashboard', 'UserController@coachingDashboard')->name('coachingdashboard');
    Route::get('/editcoaching', 'UserController@editCoaching')->name('editcoaching');
    Route::post('/coachingupdate', 'UserController@updateCoaching')->name('coachingupdate');
    Route::get('/coachingteacherpage', 'UserController@coachingTeacherPage')->name('coachingteacherpage');

    Route::get('/teachercourses', 'UserController@teacherCourses')->name('teachercourses');
    Route::post('/addcourse', 'UserController@addCourse')->name('addcourse');
    Route::delete('/deletecourse/{id}', 'UserController@deleteCourse')->name('deletecourse');
    Route::get('/coachingcourses', 'UserController@coachingCourses')->name('coachingcourses');

    Route::get('/teacherdashboard', 'UserController@teacherDashboard')->name('teacherdashboard');
    Route::get('/editteacher', 'UserController@editTeacher')->name('editteacher');
    Route::post('/teacherupdate', 'UserController@updateTeacher')->name('teacherupdate');

    Route::get('/studentdashboard', 'UserController@studentDashboard')->name('studentdashboard');
    Route::get('/editstudent', 'UserController@editStudent')->name('editstudent');
    Route::post('/studentupdate', 'UserController@updateStudent')->name('updatestudent');
    Route::get('/coachingrecommendation', 'UserController@coachingRecommendation')->name('coachingrecommendation');
    Route::get('/teacherrecommendation', 'UserController@teacherRecommendation')->name('teacherrecommendation');


    Route::group(['prefix' => 'coaching/zoom-meeting', 'as' => 'coaching.meetings.'], function ($router) {
        $router->get('/', 'CoachingController@meetingIndex')->name('index');
        $router->get('edit/{id}', 'CoachingController@meetingEdit')->name('edit');
        $router->post('update/{id}', 'CoachingController@meetingUpdate')->name('update');
        $router->delete('destroy/{id}', 'CoachingController@meetingDelete')->name('destroy');
        $router->get('/schedule', 'CoachingController@meetingSchedule')->name('schedule');
        $router->match(['GET', 'POST'], '/configuration', 'CoachingController@meetingConfiguration')->name('configuration');
        $router->get('/configuration/edit/{id}', 'CoachingController@meetingConfigurationEdit')->name('configuration.edit');
        $router->PATCH('/configuration/update/{id}', 'CoachingController@meetingConfigurationUpdate')->name('configuration.update');
        $router->POST('/store', 'TeacherController@meetingStore')->name('store');
        Route::get('/help', function () {
            $type = 'coaching';
            return view('setup-zoom-meeting.introduction', compact('type'));
        })->name('help');
    });


    Route::group(['prefix' => 'teachers/zoom-meeting', 'as' => 'teachers.meetings.'], function ($router) {
        $router->get('/', 'TeacherController@meetingIndex')->name('index');
        $router->get('edit/{id}', 'TeacherController@meetingEdit')->name('edit');
        $router->post('update/{id}', 'TeacherController@meetingUpdate')->name('update');
        $router->delete('destroy/{id}', 'TeacherController@meetingDelete')->name('destroy');
        $router->get('/schedule', 'TeacherController@meetingSchedule')->name('schedule');
        $router->match(['GET', 'POST'], '/configuration', 'TeacherController@meetingConfiguration')->name('configuration');
        $router->get('/configuration/edit/{id}', 'TeacherController@meetingConfigurationEdit')->name('configuration.edit');
        $router->PATCH('/configuration/update/{id}', 'TeacherController@meetingConfigurationUpdate')->name('configuration.update');
        $router->POST('/store', 'TeacherController@meetingStore')->name('store');
        Route::get('/help', function () {
            $type = 'teacher';
            return view('setup-zoom-meeting.introduction', compact('type'));
        })->name('help');
    });


});

Route::group(['middleware' => ['auth', 'is_admin']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/subscription', 'HomeController@subscription');
    Route::get('/enquiry', 'HomeController@enquiry');

    Route::get('/event', 'HomeController@event');
    Route::get('/addeventpage', 'HomeController@addEventPage');
    Route::post('/addevent', 'HomeController@addEvent');
    Route::delete('/event-delete/{id}', 'HomeController@deleteEvent')->name('events.destroy');

    Route::get('/level', 'HomeController@level');
    Route::get('/addlevelpage', 'HomeController@addLevelPage');
    Route::post('/addlevel', 'HomeController@addLevel');
    Route::delete('/leveldelete/{id}', 'HomeController@deleteLevel');

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


    Route::group(['prefix' => 'api'], function () {
        Route::get('/meetings', 'Zoom\MeetingController@index')
            ->name('meetings.index');

        Route::get('/zoom-setup-create', 'Zoom\MeetingController@zoomSetupCreate')
            ->name('meetings.setup-create');
        Route::get('/zoom-setup', 'Zoom\MeetingController@zoomSetup')
            ->name('meetings.setup');
// Create meeting room using topic, agenda, start_time.
        Route::post('/meetings', 'Zoom\MeetingController@store')
            ->name('meetings.store');
        Route::get('/meetings/create', 'Zoom\MeetingController@create')
            ->name('meetings.create');
// Get information of the meeting room by ID.
        Route::get('/meetings/{meeting}', 'Zoom\MeetingController@edit')
            ->where('meeting', '[0-9]+')->name('meetings.edit');
        Route::patch('/meetings/{meeting}', 'Zoom\MeetingController@update')
            ->where('meeting', '[0-9]+')->name('meetings.update');
        Route::delete('/meetings/{meeting}', 'Zoom\MeetingController@destroy')
            ->where('meeting', '[0-9]+')->name('meetings.destroy');

    });
});

Route::get('laravel-logs', function () {
//    if (\Illuminate\Support\Facades\Auth::user()->isSuper()) {
        $controller = new \Rap2hpoutre\LaravelLogViewer\LogViewerController();
        return $controller->index();
//    } else {
//        abort(404);
//    }
})->name('laravel.logs')->middleware('auth');

Route::get('/zoom-meeting-rooms', function () {
    $type = 'admin';
    return view('setup-zoom-meeting.introduction', compact('type'));
})->name('zoom-meeting-rooms');

Route::resource('zoom-meeting-config', 'Zoom\ZoomMetingConfiguration');
