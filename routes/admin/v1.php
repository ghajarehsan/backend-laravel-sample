<?php

use Illuminate\Support\Facades\Route;


//authentication
Route::group(['prefix' => 'auth'], function () {
    Route::post('sendOtpCode', [\App\Http\Controllers\Common\AuthController::class, 'sendOtpCode']);
    Route::post('checkOtpCode', [\App\Http\Controllers\Common\AuthController::class, 'checkOtpCode']);
});

//permission
Route::group(['prefix' => 'permission'], function () {
    //give permissions to user
    Route::post('givePermissionToUser', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'givePermissionTo']);
    Route::post('detachPermissionTo', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'detachPermissionTo']);
    Route::post('addPermissionTo', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'addPermissionTo']);
    //give roles to user
    Route::post('giveRoleToUser', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'giveRoleToUser']);
    Route::post('detachRoleTo', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'detachRoleToUser']);
    Route::post('addRoleTo', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'addRoleToUser']);
    //give permissions to role
    Route::post('givePermissionToRole', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'givePermissionToRole']);
    Route::post('detachPermissionToRole', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'detachPermissionToRole']);
    Route::post('addPermissionToRole', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'addPermissionToRole']);
});


Route::get('/testEhsan', function () {
    dd('testEhsan');
});
