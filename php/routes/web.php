<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', 'IndexController@index');

Route::get('/aliyun', 'AliyunController@index');


Route::get('/geetest', 'GeetestController@index');
Route::get('/geetest/preProcess', 'GeetestController@getPreProcess');
Route::post('/geetest/validate', 'GeetestController@validateCode');

Route::get('/touclick', 'TouclickController@index');
Route::get('/touclick/{type}', 'TouclickController@getPage');
Route::post('/touclick/validate', 'TouclickController@validateCode');

