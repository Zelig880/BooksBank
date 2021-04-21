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

// Library
Route::get('/library/{latitude}/{longitude}/{radius}', 'Library\SearchController@index');

// Geolocation
Route::post('/geolocation/getGeolocationByUserQuery', 'Geolocation\GeolocationController@getGeolocationByUserQuery');

Route::group(['middleware' => 'guest:api'], function () {
    // Auth
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    // Bookshelf and Bookshelf Item
    Route::get('/bookshelf_item', 'Bookshelf\BookshelfItemManagementController@index');
    Route::post('/bookshelf_item/store', 'Bookshelf\BookshelfItemManagementController@store');
    Route::get('/bookshelf_item/{id}', 'Bookshelf\BookshelfItemManagementController@getByBookshelfItemId');

    Route::get('/bookshelf', 'Bookshelf\BookshelfManagementController@current');
    Route::put('/bookshelf/{id}/update', 'Bookshelf\BookshelfManagementController@update');

    Route::get('/bookshelf/{type}/{text}', 'Bookshelf\SearchController@index');
    Route::delete('/bookshelf/remove/{id}', 'Bookshelf\LibraryController@remove');

    Route::post('/geolocation/getAddressFromGeolocation', 'Geolocation\GeolocationController@getAddressFromGeolocation');

    // Ledge
    Route::get('/ledge', 'Ledge\ManagementController@getAll');
    Route::post('/ledge/request/', 'Ledge\ManagementController@request');
    Route::post('/ledge/request/respond', 'Ledge\ManagementController@respond');

    // User
    Route::get('/user', 'Auth\UserController@current');

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
});
