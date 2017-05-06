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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => '{slug}', 'middleware' => ['auth', 'userIsPartOfBusiness']], function () {
    Route::get('/', 'BusinessController@show');
    Route::group(['namespace' => 'Settings'], function () {
        Route::get('settings', 'SettingsController@show');
        Route::post('settings', 'SettingsController@update');
    });

    // Routes that require our Stripe Auth
    Route::group(['middleware' => 'stripeAuth'], function () {
        Route::resource('sequence', 'SequenceController');
    });
});
