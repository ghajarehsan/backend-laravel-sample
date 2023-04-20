<?php

namespace App\Observers;

use App\Models\PermissionCategory;
use Illuminate\Support\Facades\Cache;

class PermissionCategoryObserver
{
    /**
     * Handle the PermissionCategory "created" event.
     */
    public function created(PermissionCategory $permissionCategory): void
    {
        Cache::forget('permissionCategory');
        Cache::forget('allDatisPermissions');
        Cache::forget('permissionRole');
    }

    /**
     * Handle the PermissionCategory "updated" event.
     */
    public function updated(PermissionCategory $permissionCategory): void
    {
        Cache::forget('permissionCategory');
        Cache::forget('allDatisPermissions');
        Cache::forget('permissionRole');
    }

    /**
     * Handle the PermissionCategory "deleted" event.
     */
    public function deleted(PermissionCategory $permissionCategory): void
    {
        Cache::forget('permissionCategory');
        Cache::forget('allDatisPermissions');
        Cache::forget('permissionRole');
    }

    /**
     * Handle the PermissionCategory "restored" event.
     */
    public function restored(PermissionCategory $permissionCategory): void
    {
        Cache::forget('permissionCategory');
        Cache::forget('allDatisPermissions');
        Cache::forget('permissionRole');
    }

    /**
     * Handle the PermissionCategory "force deleted" event.
     */
    public function forceDeleted(PermissionCategory $permissionCategory): void
    {
        Cache::forget('permissionCategory');
        Cache::forget('allDatisPermissions');
        Cache::forget('permissionRole');
    }
}
