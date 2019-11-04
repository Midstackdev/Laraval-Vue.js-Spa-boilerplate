<?php

Route::post('/register', 'Auth\AuthController@register');
Route::post('/login', 'Auth\AuthController@login');
Route::post('/logout', 'Auth\AuthController@logout');


Route::get('/me', 'Auth\AuthController@me');

Route::group(['middleware' => 'auth:api'], function() {
	Route::get('/timeline', 'TimelineController@index');
    
});
