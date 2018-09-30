<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('branch','BranchController');
Route::resource('group','GroupController');
Route::resource('account','AccountController');
Route::resource('loan','LoanController');
Route::resource('payment','PaymentController');
