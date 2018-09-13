<?php
use Illuminate\Http\Request;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('news','NewContentController');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/number_of_articals','NewContentController@number_of_articals');