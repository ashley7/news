<?php

Route::get('/', function () {
    return redirect('/news');
});

Route::resource('news','NewContentController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/number_of_articals','NewContentController@number_of_articals');
