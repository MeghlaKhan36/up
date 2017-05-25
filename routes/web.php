<?php

use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', 'HomeController@home');
Route::get('/home', 'HomeController@home');

Route::group(['middleware' => 'auth'], function () {
    Route::post('decrypt/file/{id}', 'FileController@decryptFile');

    Route::get('files', 'HomeController@recentFiles');

    Route::get('download/{id}', 'FileController@download');
    Route::get('upload', 'FileController@newFile');
    Route::post('file/create', 'FileController@create');
    Route::get('settings/files/{id}', 'FileController@settings');
    Route::get('edit/file/{id}', 'FileController@updateFile');
    Route::post('save/file/{id}', 'FileController@saveUpdatedFile');
    Route::get('delete/file/{id}', 'FileController@deleteFile');

    Route::get('messages/{id}', 'MessageController@messageInbox');
    Route::get('share/file/{id}', 'MessageController@shareFile');
    Route::post('send/file/{id}', 'MessageController@sendFile');
    Route::get('messages/{user_id}/{msg_id}', 'MessageController@displayMessage');
    Route::get('delete/message/{id}', 'MessageController@deleteMessage');

    Route::get('search/user', 'SearchController@search');
    Route::get('user/{id}', 'UserController@profile');
    Route::get('logout', 'UserController@logout');
    Route::get('settings/{id}', 'UserController@settings');
    Route::put('profile/update/{id}', 'UserController@updateProfile');
    Route::post('account/update/{id}', 'UserController@updateAccount');

});
