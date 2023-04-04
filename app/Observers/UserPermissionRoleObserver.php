<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use SplSubject;

class UserPermissionRoleObserver implements \SplObserver
{
    //
    public function update(SplSubject $subject)
    {
        Cache::forget('userPermission-' . $subject->mobile);
        Cache::forget('userRole-' . $subject->mobile);
     }
}
