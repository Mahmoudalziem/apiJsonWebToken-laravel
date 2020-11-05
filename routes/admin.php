<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ['api','jwt.verify:admin','lang'],
        'prefix' => 'admin',
        'namespace' => 'Admin'
    ],

    function(){

        Route::post('info', 'adminController@show');

        /// Course resources

        Route::resource('course', 'courseController');
    }
);
