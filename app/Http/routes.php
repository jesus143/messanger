<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



Route::group(['prefix' => 'user'], function(){
	Route::get("profile", ['uses'=>'UserController@getProfile', 'as'=> 'user.profile']);
	Route::get("contact", ['uses'=>'UserController@getContact', 'as'=> 'user.contact']);

	Route::get("delete/{id}", ['uses'=>'UserController@deleteUser', 'as'=> 'user.delete']);

	Route::post("profile/update/{id?}", ['uses'=>'UserController@updateProfile', 'as'=> 'user.profile.update']);
	Route::post("password/update/{id?}", ['uses'=>'UserController@updatePassword', 'as'=> 'user.password.update']);


	Route::post('sms/send/', ['uses'=>'SmsController@sendSms', 'as'=> 'user.sms.send']);
	Route::resource("sms", "SmsController");
});


Route::resource("user", "UserController");







