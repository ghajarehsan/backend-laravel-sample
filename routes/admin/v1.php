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
    Route::post('newProductBrand', [\App\Http\Controllers\Admin\BrandController::class, 'newProductBrand'])->middleware('permission:newProductBrand');
    Route::post('editProductBrand/{productBrandId}', [\App\Http\Controllers\Admin\BrandController::class, 'editProductBrand'])->middleware('permission:editProductBrand');
    Route::post('deleteProductBrand/{productBrandId}', [\App\Http\Controllers\Admin\BrandController::class, 'deleteProductBrand'])->middleware('permission:deleteProductBrand');
    Route::post('uploadFileNewProductBrand', [\App\Http\Controllers\Admin\BrandController::class, 'uploadFileNewProductBrand'])->middleware('permission:newProductBrand');
    Route::get('getAllProductBrand', [\App\Http\Controllers\Admin\BrandController::class, 'getAllProductBrand'])->middleware('permission:getAllProductBrand');
});

//product category
Route::group(['prefix' => 'productCategory'], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::post('newProductCategory', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'newProductCategory'])->middleware('permission:newProductCategory');
        Route::post('editProductCategory/{productCategoryId}', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'editProductCategory'])->middleware('permission:editProductCategory');
        Route::post('deleteProductCategory/{productCategoryId}', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'deleteProductCategory'])->middleware('permission:deleteProductCategory');
        Route::get('getAllProductCategory/{productCategoryId?}', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'getAllProductCategory'])->middleware('permission:getAllProductCategory');
        Route::post('uploadFileNewProductCategory', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'uploadFileNewProductCategory'])->middleware('permission:newProductCategory');
    });
    Route::group(['prefix' => 'categoryFilter'], function () {
        Route::post('newProductCategoryFilter', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'newProductCategoryFilter'])->middleware('permission:newProductCategoryFilter');
        Route::post('editProductCategoryFilter/{productCategoryFilterId}', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'editProductCategoryFilter'])->middleware('permission:editProductCategoryFilter');
        Route::post('deleteProductCategoryFilter/{productCategoryFilterId}', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'deleteProductCategoryFilter'])->middleware('permission:deleteProductCategoryFilter');
    });
    Route::group(['prefix' => 'categoryFilterOption'], function () {
        Route::post('newProductCategoryFilterOption', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'newProductCategoryFilterOption'])->middleware('permission:newProductCategoryFilterOption');
        Route::post('editProductCategoryFilterOption/{productCategoryFilterOptionId}', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'editProductCategoryFilterOption'])->middleware('permission:editProductCategoryFilterOption');
        Route::post('deleteProductCategoryFilterOption/{productCategoryFilterOptionId}', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'deleteProductCategoryFilterOption'])->middleware('permission:deleteProductCategoryFilterOption');
    });
});







