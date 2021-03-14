<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    //Bookshef
    Route::get('/bookshelf', 'Bookshelf\ManagementController@getAll');

    Route::post('/geolocation/getAddressFromGeolocation', 'Geolocation\GeolocationController@getAddressFromGeolocation');
    
    Route::post('/bookshelf/store', 'Bookshelf\ManagementController@store');
    Route::get('/bookshelf/bookshelf_item/{id}', 'Bookshelf\ManagementController@getByBookshelfItemId');
    Route::delete('/bookshelf/remove/{id}', 'Bookshelf\LibraryController@remove');
    Route::get('/bookshelf/{type}/{text}', 'Bookshelf\SearchController@index');

    //Ledge
    Route::get('/ledge', 'Ledge\ManagementController@getAll');
    Route::post('/ledge/request/', 'Ledge\ManagementController@request');
    Route::post('/ledge/request/respond', 'Ledge\ManagementController@respond');


    Route::get('/user', 'Auth\UserController@current');

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
    //LIBRARY
    Route::get('/library/{latitude}/{longitude}/{radius}', 'Library\SearchController@index');
    //GEOLOCATION
    Route::post('/geolocation/getGeolocationByUserQuery', 'Geolocation\GeolocationController@getGeolocationByUserQuery');
    Route::post('/geolocation/getGeolocationByPostcode', 'Geolocation\GeolocationController@getGeolocationByPostcode');
});
