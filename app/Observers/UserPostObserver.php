<?php

namespace App\Observers;

use App\Models\UserPost;
use Illuminate\Support\Facades\Cache;

class UserPostObserver
{
    /**
     * Handle the UserPost "created" event.
     */
    public function created(UserPost $userPost): void
    {
        Cache::forget('userPosts');
    }

    /**
     * Handle the UserPost "updated" event.
     */
    public function updated(UserPost $userPost): void
    {
        //
    }

    /**
     * Handle the UserPost "deleted" event.
     */
    public function deleted(UserPost $userPost): void
    {
        //
    }

    /**
     * Handle the UserPost "restored" event.
     */
    public function restored(UserPost $userPost): void
    {
        //
    }

    /**
     * Handle the UserPost "force deleted" event.
     */
    public function forceDeleted(UserPost $userPost): void
    {
        //
    }
}
