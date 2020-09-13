<?php

// Public Routes
// Route group for authenticated uses only
Route::group(['middleware' => ['auth:api']], function(){

});

// Routes for guest only

Route::group(['middleware' => ['guest:api']], function(){
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('verification/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('verification/resend', 'Auth\VerificationController@resend');
    Route::post('login', 'Auth\LoginController@login');
});
