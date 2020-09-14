<?php

// Public Routes
Route::get('me', 'User\MeController@Me');

// Route group for authenticated uses only
Route::group(['middleware' => ['auth:api']], function(){
    Route::post('logout', 'Auth\LoginController@logout');

    Route::put('settings/pofile', 'User\SettingsController@updateProfile');
    Route::put('settings/password', 'User\SettingsController@updatePassword');

    // Upload Designs
    Route::post('designs', 'Designs\UploadController@upload');
});

// Routes for guest only

Route::group(['middleware' => ['guest:api']], function(){
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('verification/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('verification/resend', 'Auth\VerificationController@resend');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});
