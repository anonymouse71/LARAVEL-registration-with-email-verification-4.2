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

Route::get('/',function(){
	return Redirect::route('dashboard');
});



Route::group(['before' => 'guest'], function(){

	Route::controller('password', 'RemindersController');
	Route::get('login', ['as'=>'login','uses' => 'AuthController@login']);
	Route::post('login', array('uses' => 'AuthController@doLogin'));

   //resister
	Route::get('register',['as'=>'user.create','uses'=>'UserController@create']);
	Route::post('register',['as'=>'user.store','uses'=>'UserController@store']);

    //Activation system
	Route::get('register/activation/{key}',['uses'=>'ActivationController@activate']);
	Route::get('activationRequest', ['as'=>'activationRequest', 'uses'=>'ActivationController@viewActivationRequest']);
	Route::post('sendActivationLink',['as'=>'sendActivationLink','uses'=>'ActivationController@sendActivationLink']);

});



Route::group(array('before' => 'auth|activation'), function()
{
	Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

	//login section
	Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'AuthController@dashboard'));
	Route::get('change-password', array('as' => 'password.change', 'uses' => 'AuthController@changePassword'));
	Route::post('change-password', array('as' => 'password.doChange', 'uses' => 'AuthController@doChangePassword'));

	//profile section
	Route::get('profile', ['as'=>'user.show', 'uses'=>'UserController@show']);
    Route::get('edit-profile',['as'=>'user.edit', 'uses'=>'UserController@edit']);
	Route::post('update-profile',['as'=>'user.update', 'uses'=>'UserController@update']);

	//image section
	Route::get('upload-avatar',['as'=>'upload.avatar', 'uses'=>'UserController@uploadAvatarForm']);
	Route::post('upload-avatar',['as'=>'upload.avatar', 'uses'=>'UserController@uploadAvatar']);


});




