<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
    Route::group(['prefix' => '{slug}'], function () {
        Route::resource('sequence', 'SequenceController');
    });
});

Route::group(['prefix' => '{slug}'], function () {
    Route::group(['namespace' => 'Webhook'], function () {
        Route::post('webhook/stripe', 'StripeWebhookController@receive')->middleware('stripeAuth');
    });
});
