<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use SplSubject;

class PermissionRoleObserver implements \SplObserver
{
    //
    public function update(SplSubject $subject)
    {
        Cache::forget('permissionRole');
    }
}
