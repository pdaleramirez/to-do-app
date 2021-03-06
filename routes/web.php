<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/to-do', function () {
    return view('to-do-list');
});

Route::get('/email-checker', function () {
    return view('email-checker');
});

Route::post('email-checker-process', 'EmailCheckerController@processDomains');

Route::apiResource('to-do-list', 'ToDoController');