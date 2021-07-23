<?php
// Public routes
// Route group to authenticated users only
Route::group(['middleware' => 'auth:api'], function ($router) {
});

// Routes for guest only
Route::group(['middleware' => 'guest:api'], function () {
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('verification/verify', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('verification/resend', 'Auth\VerificationController@resend');
});
