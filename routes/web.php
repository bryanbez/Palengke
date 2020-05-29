<?php

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('{any}', function() {
      return view('index');
  })->where('any', '.*');
