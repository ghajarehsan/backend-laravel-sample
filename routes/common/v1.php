<?php

use Illuminate\Support\Facades\Route;

//authentication
Route::group(['prefix' => 'auth'], function () {
    Route::post('sendOtpCode', [\App\Http\Controllers\Common\AuthController::class, 'sendOtpCode']);
    Route::post('checkOtpCode', [\App\Http\Controllers\Common\AuthController::class, 'checkOtpCode']);
});


//upload file
Route::group(['prefix' => 'uploadFile', 'middleware' => 'auth:sanctum'], function () {
    Route::post('upload', [\App\Http\Controllers\Common\UploadFileController::class, 'uploadFile']);
});
