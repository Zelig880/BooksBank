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
Route::get('library/{latitude}/{longitude}/{radius}', 'Library\SearchController@index');

// Bookshelf
Route::get('bookshelf_item/{id}', 'Bookshelf\BookshelfItemManagementController@getByBookshelfItemId');


// Geolocation
Route::post('geolocation/getGeolocationByUserQuery', 'Geolocation\GeolocationController@getGeolocationByUserQuery');
Route::post('geolocation/getGeolocationByPostcode', 'Geolocation\GeolocationController@getGeolocationByPostcode');
Route::get('library/{latitude}/{longitude}/{radius}', 'Library\SearchController@index');

// Geolocation
Route::post('geolocation/getGeolocationByUserQuery', 'Geolocation\GeolocationController@getGeolocationByUserQuery');
Route::post('geolocation/getAddressFromGeolocation', 'Geolocation\GeolocationController@getAddressFromGeolocation');

//Newsletter
Route::post('newsletter/createContact', 'NewsletterController@createContact');

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

    // Ledge
    Route::prefix('ledge')->group(function () {
        Route::get('', 'Ledge\ManagementController@getAll');
        Route::post('request', 'Ledge\ManagementController@request');
        Route::put('request/respond/{ledge_id}', 'Ledge\ManagementController@respond');
        Route::put('request/return/{id}', 'Ledge\ManagementController@return');
        Route::put('collect/{id}', 'Ledge\ManagementController@collect');
        Route::put('cancel/{id}', 'Ledge\ManagementController@cancel');
        Route::put('returned/{id}', 'Ledge\ManagementController@returned');
        Route::post('return_request', 'Ledge\ManagementController@returnRequest');
        Route::put('return_request/respond/{ledge_id}', 'Ledge\ManagementController@returnRespond');

        // messages
        Route::get('messages/{ledge_id}', 'Ledge\LedgeMessageController@getMessagesByLedgeId');
        Route::post('message', 'Ledge\LedgeMessageController@sendMessage');
    });

    // User
    Route::get('user', 'Auth\UserController@current');

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    // Bookshelf and Bookshelf Item
    Route::get('bookshelf_item', 'Bookshelf\BookshelfItemManagementController@index');
    Route::post('bookshelf_item/store', 'Bookshelf\BookshelfItemManagementController@store');
    Route::delete('bookshelf_item/delete/{id}', 'Bookshelf\BookshelfItemManagementController@removeBookShelfItem');

    Route::get('bookshelf', 'Bookshelf\BookshelfManagementController@current');
    Route::put('bookshelf/{id}/update', 'Bookshelf\BookshelfManagementController@update');
    Route::post('bookshelf/create', 'Bookshelf\BookshelfManagementController@create');

    Route::get('bookshelf/{type}/{text}', 'Bookshelf\SearchController@index');
    Route::delete('bookshelf/remove/{id}', 'Bookshelf\LibraryController@remove');

    // User
    Route::get('user', 'Auth\UserController@current');

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    //Newsletter
    Route::get('newsletter/getAccount', 'NewsletterController@getAccount');
});
