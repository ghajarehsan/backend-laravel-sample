<?php

use Illuminate\Support\Facades\Route;


//permission
Route::group(['prefix' => 'permission'], function () {
    //give permissions to user
    Route::post('givePermissionToUser', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'givePermissionTo'])->middleware('permission:givePermissionToUser');
    Route::post('detachPermissionTo', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'detachPermissionTo'])->middleware('permission:detachPermissionTo');
    Route::post('addPermissionTo', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'addPermissionTo'])->middleware('permission:addPermissionTo');
    //give roles to user
    Route::post('giveRoleToUser', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'giveRoleToUser'])->middleware('permission:giveRoleToUser');
    Route::post('detachRoleTo', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'detachRoleToUser'])->middleware('permission:detachRoleTo');
    Route::post('addRoleTo', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'addRoleToUser'])->middleware('permission:addRoleTo');
    //give permissions to role
    Route::post('givePermissionToRole', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'givePermissionToRole'])->middleware('permission:givePermissionToRole');
    Route::post('detachPermissionToRole', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'detachPermissionToRole'])->middleware('permission:detachPermissionToRole');
    Route::post('addPermissionToRole', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'addPermissionToRole'])->middleware('permission:addPermissionToRole');
    //permission category
    Route::post('newPermissionCategory', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'newPermissionCategory'])->middleware('permission:newPermissionCategory');
    Route::post('editPermissionCategory/{permissionCategory}', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'editPermissionCategory'])->middleware('permission:editPermissionCategory');
    Route::get('getAllCategoryPermission', [\App\Http\Controllers\Admin\PermissionRoleController::class, 'getAllCategoryPermission'])->middleware('permission:getAllCategoryPermission');
});

//department
Route::group(['prefix' => 'userDepartmentPost'], function () {
    //posts
    Route::post('newUserPost', [\App\Http\Controllers\Admin\UserDepartmentPostController::class, 'newUserPost'])->middleware('permission:newUserPost');
    Route::get('getAllPost', [\App\Http\Controllers\Admin\UserDepartmentPostController::class, 'getAllPost'])->middleware('permission:getAllPost');
    //departments
    Route::post('newUserDepartment', [\App\Http\Controllers\Admin\UserDepartmentPostController::class, 'newUserDepartment'])->middleware('permission:newUserDepartment');
    Route::get('getAllDepartment/{department_id?}', [\App\Http\Controllers\Admin\UserDepartmentPostController::class, 'getAllDepartment'])->middleware('permission:getAllDepartment');
});

//product brand
Route::group(['prefix' => 'brand'], function () {
    Route::post('newBrand', [\App\Http\Controllers\Admin\BrandController::class, 'newBrand']);
});

Route::get('testEhsan', function () {
    dd(\App\Models\User::find(1)->createToken('apiToken'));
});


