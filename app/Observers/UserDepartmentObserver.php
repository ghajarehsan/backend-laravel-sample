<?php

namespace App\Observers;

use App\Models\UserDepartment;
use Illuminate\Support\Facades\Cache;

class UserDepartmentObserver
{
    /**
     * Handle the UserDepartment "created" event.
     */
    public function created(UserDepartment $userDepartment): void
    {
        Cache::forget('userDepartment'.$userDepartment->id);
    }

    /**
     * Handle the UserDepartment "updated" event.
     */
    public function updated(UserDepartment $userDepartment): void
    {
        //
    }

    /**
     * Handle the UserDepartment "deleted" event.
     */
    public function deleted(UserDepartment $userDepartment): void
    {
        //
    }

    /**
     * Handle the UserDepartment "restored" event.
     */
    public function restored(UserDepartment $userDepartment): void
    {
        //
    }

    /**
     * Handle the UserDepartment "force deleted" event.
     */
    public function forceDeleted(UserDepartment $userDepartment): void
    {
        //
    }
}
