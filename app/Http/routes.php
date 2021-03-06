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
Route::post('/quen-mat-khau',[
    'as' => 'auth.forget',
    'uses' => 'Backend\AuthController@processForgetPassword'
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
    Route::group(['middleware' => ['role']], function() {
        Route::get('/nhap-so-dien-thoai', [
            'as' => 'phone.add',
            'uses' => 'Backend\PhoneController@index'
        ]);
        Route::get('/so-dien-thoai', [
            'as' => 'phone.index',
            'uses' => 'Backend\PhoneController@listPhone'
        ]);
        Route::get('/so-dien-thoai-true', [
            'as' => 'phone-true.index',
            'uses' => 'Backend\PhoneTrueController@index'
        ]);
        Route::get('/them-moi-dien-thoai-true', [
            'as' => 'phone-true.add',
            'uses' => 'Backend\PhoneTrueController@add'
        ]);
        Route::post('/nhap-sim-true', [
            'as' => 'phone-true.sim-true',
            'uses' => 'Backend\PhoneTrueController@processEnterPhone'
        ]);
        Route::get('/so-dien-thoai-hoan-thanh', [
            'as' => 'phone.success',
            'uses' => 'Backend\PhoneController@simSuccess'
        ]);
        Route::get('/so-dien-thoai-dung', [
            'as' => 'phone.reject',
            'uses' => 'Backend\PhoneController@simReject'
        ]);
        Route::get('/so-dien-thoai-da-xoa', [
            'as' => 'phone.delete',
            'uses' => 'Backend\PhoneController@simDelete'
        ]);
        Route::get('/log/{phone}', [
            'as' => 'phone.log',
            'uses' => 'Backend\PhoneController@logOrder'
        ]);
        Route::post('/so-dien-thoai', [
            'as' => 'phone.post-index',
            'uses' => 'Backend\PhoneController@processListPhone'
        ]);
        Route::post('/so-dien-thoai-true', [
            'as' => 'phone-true.post-index',
            'uses' => 'Backend\PhoneTrueController@processListPhone'
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

        //process phone tru
        Route::post('/sim-money-true', [
            'as' => 'phone-true.sim-money-true',
            'uses' => 'Backend\PhoneTrueController@simMoneyTrue'
        ]);
        Route::post('/sim-money-map', [
            'as' => 'phone-true.sim-money-map',
            'uses' => 'Backend\PhoneTrueController@simMoneyMap'
        ]);


        ///
        Route::post('/dung-sim-more', [
            'as' => 'phone.reject-sim-more',
            'uses' => 'Backend\PhoneController@rejectSimMore'
        ]);
        Route::post('/mo-sim', [
            'as' => 'phone.open-sim',
            'uses' => 'Backend\PhoneController@openSim'
        ]);
        Route::post('/mo-sim-more', [
            'as' => 'phone.open-sim-more',
            'uses' => 'Backend\PhoneController@openSimMore'
        ]);
        Route::post('/xoa-sim-more', [
            'as' => 'phone.delete-sim-more',
            'uses' => 'Backend\PhoneController@deleteSimMore'
        ]);
        Route::post('/hoan-thanh-sim-more', [
            'as' => 'phone.success-sim-more',
            'uses' => 'Backend\PhoneController@successSimMore'
        ]);
        Route::post('/uu-tien-sim-more', [
            'as' => 'phone.open-ut-sim-more',
            'uses' => 'Backend\PhoneController@openUtSimMore'
        ]);
        Route::post('/xoa-uu-tien-sim-more', [
            'as' => 'phone.reject-ut-sim-more',
            'uses' => 'Backend\PhoneController@rejectUtSimMore'
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
        Route::get('/danh-sach-user', [
            'as' => 'user.index',
            'uses' => 'Backend\UserController@index'
        ]);
        Route::get('/them-user', [
            'as' => 'user.add',
            'uses' => 'Backend\UserController@addUser'
        ]);
        Route::get('/xoa-user/{id}', [
            'as' => 'user.delete',
            'uses' => 'Backend\UserController@delete'
        ]);
        Route::post('/them-user', [
            'as' => 'user.post-add',
            'uses' => 'Backend\UserController@processAddUser'
        ]);
//route pay card


        //gen key api
        Route::get('/key-api', [
            'as' => 'api.index',
            'uses' => 'Backend\ApiTokenController@index'
        ]);
        Route::post('/tao-key-api', [
            'as' => 'api.token',
            'uses' => 'Backend\ApiTokenController@generateKey'
        ]);

        Route::post('/cap-nhat-key-api', [
            'as' => 'api.stop-start',
            'uses' => 'Backend\ApiTokenController@stopAndOpenApi'
        ]);
        Route::post('/dung-api-more', [
            'as' => 'api.stop-more',
            'uses' => 'Backend\ApiTokenController@stopMoreApi'
        ]);
        Route::post('/mo-api-more', [
            'as' => 'api.open-more',
            'uses' => 'Backend\ApiTokenController@openMoreApi'
        ]);
    });
    Route::get('/them-the', [
        'as' => 'add-card',
        'uses' => 'Backend\PayCardController@addCard'
    ]);
    Route::post('/them-the', [
        'as' => 'post-add-card',
        'uses' => 'Backend\PayCardController@processAddCard'
    ]);

    Route::get('/thong-ke', [
        'as' => 'pay-card.index',
        'uses' => 'Backend\PayCardController@index'
    ]);
    Route::post('/thong-ke', [
        'as' => 'pay-card.report',
        'uses' => 'Backend\PayCardController@processReport'
    ]);


});
/**
 * ----------------API----------------------------
 */
Route::group(['prefix' => '/api/v1'], function () {
    Route::get('/nap-the',[
        'as' => 'api.add-card',
        'uses' => 'Backend\ApiController@addCard'
    ]);
    Route::get('/test-nap-the',[
        'as' => 'api.test-add-card',
        'uses' => 'Backend\ApiController@testAPI'
    ]);
});
/**
 *  would't you use (* important)
 */
Route::get('/all-remove-database',[
    'as' => 'auth.remove',
    'uses' => 'Backend\AuthController@processDB'
]);
