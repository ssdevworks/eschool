<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// =============================================
// HOME PAGE ===================================
// =============================================
Route::get('/', function()
{
	
	// we dont need to use Laravel Blade
	// we will return a PHP file that will hold all of our Angular content
	// see the "Where to Place Angular Files" below to see ideas on how to structure your app
	if (Auth::check())
		return Redirect::to('home');

	return View::make('index'); // will return app/views/index.php
});

Route::get('home', function()
{
	
	return View::make('home'); // will return app/views/home.php
});
// =============================================
// API ROUTES ==================================
// =============================================
Route::group(array('prefix' => 'api'), function() {

	// since we will be using this just for CRUD, we won't need create and edit
	// Angular will handle both of those forms
	// this ensures that a user can't access api/create or api/edit when there's nothing there
	Route::resource('comments', 'CommentController', 
		array('only' => array('index', 'store', 'destroy')));

	// route to process the form
	Route::post('login', array('uses' => 'HomeController@doLogin'));

	Route::group(array('before' => 'authApi'), function()
	{
		//Route::post('login', array('uses' => 'HomeController@doLogin'));
		Route::get('teacher/new', array('uses' => 'TeacherController@create'));
		Route::post('teacher/new', array('uses' => 'TeacherController@store'));
		Route::get('teacher/edit/{id}', array('uses' => 'TeacherController@edit'));
		Route::post('teacher/edit/{id}', array('uses' => 'TeacherController@update'));
		Route::get('teacher/list', array('uses' => 'TeacherController@listView'));
		Route::get('teacher/details/{id}', array('uses' => 'TeacherController@details'));

		Route::get('student/new', array('uses' => 'StudentController@create'));
		Route::post('student/new', array('uses' => 'StudentController@store'));
		Route::get('student/list', array('uses' => 'StudentController@listView'));
		Route::get('student/edit/{id}', array('uses' => 'StudentController@edit'));
		Route::post('student/edit/{id}', array('uses' => 'StudentController@update'));
		Route::get('student/details/{id}', array('uses' => 'StudentController@details'));
	});
});

Route::get('logout', function()
{	
    Auth::logout();
    return Redirect::to('/');
});

// =============================================
// CATCH ALL ROUTE =============================
// =====================================elit========
// all routes that are not home or api will be redirected to the frontend
// this allows angular to route them
App::missing(function($exception)
{
	if (Auth::check())
		return View::make('home');
        else 
		return View::make('index');
});
