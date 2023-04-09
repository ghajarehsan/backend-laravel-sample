<?php

use Illuminate\Support\Facades\Route;


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
    //permission category
    Route::post('newPermissionCategory', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'newPermissionCategory']);
    Route::post('editPermissionCategory/{permissionCategory}', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'editPermissionCategory']);
    Route::get('getAllCategoryPermission', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'getAllCategoryPermission']);
});

//department
Route::group(['prefix' => 'userDepartmentPost'], function () {
    //posts
    Route::post('newUserPost', [\App\Http\Controllers\Admin\UserDepartmentPostController::class, 'newUserPost']);
    Route::get('getAllPost', [\App\Http\Controllers\Admin\UserDepartmentPostController::class, 'getAllPost']);
    //departments
    Route::post('newUserDepartment', [\App\Http\Controllers\Admin\UserDepartmentPostController::class, 'newUserDepartment']);
    Route::get('getAllDepartment/{department_id?}', [\App\Http\Controllers\Admin\UserDepartmentPostController::class, 'getAllDepartment']);
});

Route::get('testEhsan', function () {
    dd(\App\Models\User::find(1)->createToken('apiToken'));
});


