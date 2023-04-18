<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\PermissionCategory;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\UserDepartment;
use App\Models\UserPost;
use App\Observers\PermissionCategoryObserver;
use App\Observers\PermissionObserver;
use App\Observers\ProductBrandObserver;
use App\Observers\ProductCategoryObserver;
use App\Observers\UserDepartmentObserver;
use App\Observers\UserPostObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        UserPost::observe(UserPostObserver::class);
        UserDepartment::observe(UserDepartmentObserver::class);
        Permission::observe(PermissionObserver::class);
        PermissionCategory::observe(PermissionCategoryObserver::class);
        ProductBrand::observe(ProductBrandObserver::class);
        ProductCategory::observe(ProductCategoryObserver::class);
    }
}
