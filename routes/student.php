<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'middleware' => ['api', 'jwt.verify:student','lang'],
        'prefix' => 'student',
        'namespace' => 'Student'
    ],
    function(){
        Route::post('info','studentController@show');
        Route::post('/comments','studentController@comments');
    }
);
