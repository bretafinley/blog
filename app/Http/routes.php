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

Route::get('/', function () {
    return view('home');
});

Route::get('/help', function () {
    return view('help');
});

Route::get('/about', function () {
    return view('about');
});

Route::post('/login', 'UserController@login');

Route::get('/logout', 'UserController@logout');

Route::get('/library', 'UserController@library');

Route::get('/game/{AppID}', 'PageController@game');

Route::get('/profile', 'PageController@profile');

Route::get('/friends', 'UserController@friends');

Route::get('/test', function () {
    return view('friends');
});
