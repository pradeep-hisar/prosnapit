<?php
use Illuminate\Http\Request;


Route::post('assetscsv', ['as' => 'api.assetscsv.store','uses' => 'CsvController@store' ]);
Route::post('userscsv', ['as' => 'api.userscsv.users_store','uses' => 'CsvController@users_store' ]);