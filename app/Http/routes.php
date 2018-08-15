<?php

/**
 * -----------------------------Backend-----------------------------
 */

Route::get('/',[
    'as' => 'auth.login',
    'uses' => 'Backend\AuthController@login'
]);
Route::get('/dang-xuat',[
    'as' => 'auth.logout',
    'uses' => 'Backend\AuthController@logout'
]);
Route::post('/',[
    'as' => 'auth.post-login',
    'uses' => 'Backend\AuthController@processLogin'
]);

/**
 * --------------------------- system---------------------------------
 */

Route::group(['middleware' => ['auth.login']], function() {
    Route::get('/bao-cao', [
        'as' => 'home.index',
        'uses' => 'Backend\HomeController@index'
    ]);

//route phone
    Route::get('/nhap-so-dien-thoai', [
        'as' => 'phone.add',
        'uses' => 'Backend\PhoneController@index'
    ]);
    Route::get('/so-dien-thoai', [
        'as' => 'phone.index',
        'uses' => 'Backend\PhoneController@listPhone'
    ]);
    Route::get('/log/{phone}', [
        'as' => 'phone.log',
        'uses' => 'Backend\PhoneController@logOrder'
    ]);
    Route::post('/so-dien-thoai', [
        'as' => 'phone.post-index',
        'uses' => 'Backend\PhoneController@processListPhone'
    ]);

    Route::post('/upload-file', [
        'as' => 'phone.upload',
        'uses' => 'Backend\PhoneController@processUploadFile'
    ]);
    Route::post('/nhap-sim', [
        'as' => 'phone.sim',
        'uses' => 'Backend\PhoneController@processEnterPhone'
    ]);
    Route::post('/dung-sim', [
        'as' => 'phone.reject-sim',
        'uses' => 'Backend\PhoneController@rejectSim'
    ]);
    Route::post('/mo-sim', [
        'as' => 'phone.open-sim',
        'uses' => 'Backend\PhoneController@openSim'
    ]);

//route user
    Route::get('/doi-mat-khau', [
        'as' => 'user.reset-password',
        'uses' => 'Backend\UserController@resetPassword'
    ]);
    Route::post('/doi-mat-khau', [
        'as' => 'user.post-reset-password',
        'uses' => 'Backend\UserController@processResetPassword'
    ]);
    Route::get('/thong-tin-ca-nhan', [
        'as' => 'user.profile',
        'uses' => 'Backend\UserController@profile'
    ]);
//route pay card

    Route::get('/thong-ke', [
        'as' => 'pay-card.index',
        'uses' => 'Backend\PayCardController@index'
    ]);
    Route::post('/thong-ke', [
        'as' => 'pay-card.report',
        'uses' => 'Backend\PayCardController@processReport'
    ]);

    /**
     * ----------------API----------------------------
     */
});
Route::group(['prefix' => '/api/v1'], function () {
    Route::get('/nap-the',[
        'as' => 'api.add-card',
        'uses' => 'Backend\ApiController@addCard'
    ]);
});