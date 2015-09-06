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
    return view('index');
});

// API ROUTES ==================================
Route::group(array('prefix' => 'api'), function () {

    // API version 1.0
    Route::group(array('prefix' => '1.0'), function ()
    {
        // since we will be using this just for CRUD, we won't need create and edit
        // Angular will handle both of those forms
        // this ensures that a user can't access api/create or api/edit when there's nothing there
        Route::resource('requests', 'TbIsRequestController',
            array('only' => array('index')));

    });
});