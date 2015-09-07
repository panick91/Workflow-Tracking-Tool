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
        Route::resource('requests', 'EIsRequestController',
            array('only' => array('index')));

        Route::resource('orders', 'Orders\OrdersController',
            array('only' => array('index','show')));

        Route::resource('orders.timeline', 'Orders\TimelineController',
            array('only' => array('index')));

        Route::resource('orders.progress', 'Orders\ProgressController',
            array('only' => array('index')));

        Route::resource('orders.history', 'Orders\HistoryController',
            array('only' => array('index')));

        Route::resource('projectstatus', 'ProjectStatusController',
            array('only' => array('index')));
    });
});