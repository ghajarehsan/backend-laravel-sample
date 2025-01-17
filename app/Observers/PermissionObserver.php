<?php

namespace App\Observers;

use App\Models\Permission;
use Illuminate\Support\Facades\Cache;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     */
    public function created(Permission $permission): void
    {
        Cache::forget('permissionCategory');
        Cache::forget('allDatisPermissions');
        Cache::forget('permissionRole');
    }

    /**
     * Handle the Permission "updated" event.
     */
    public function updated(Permission $permission): void
    {
        Cache::forget('permissionCategory');
        Cache::forget('allDatisPermissions');
        Cache::forget('permissionRole');
    }

    /**
     * Handle the Permission "deleted" event.
     */
    public function deleted(Permission $permission): void
    {
        Cache::forget('permissionCategory');
        Cache::forget('allDatisPermissions');
        Cache::forget('permissionRole');
    }

    /**
     * Handle the Permission "restored" event.
     */
    public function restored(Permission $permission): void
    {
        Cache::forget('permissionCategory');
        Cache::forget('allDatisPermissions');
        Cache::forget('permissionRole');
    }

    /**
     * Handle the Permission "force deleted" event.
     */
    public function forceDeleted(Permission $permission): void
    {
        Cache::forget('permissionCategory');
        Cache::forget('allDatisPermissions');
        Cache::forget('permissionRole');
    }
}
