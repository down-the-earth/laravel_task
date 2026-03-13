<?php

namespace App\Observers;

use App\Models\POST;

class PostObserver
{
    /**
     * Handle the POST "created" event.
     */
    public function created(POST $pOST): void
    {
        //
    }

    /**
     * Handle the POST "updated" event.
     */
    public function updated(POST $pOST): void
    {
        //
    }

    /**
     * Handle the POST "deleted" event.
     */
    public function deleted(POST $pOST): void
    {
        // Delete all comments associated with the post
        $pOST->comments()->delete();
    }

    /**
     * Handle the POST "restored" event.
     */
    public function restored(POST $pOST): void
    {
        //
    }

    /**
     * Handle the POST "force deleted" event.
     */
    public function forceDeleted(POST $pOST): void
    {
        //
    }
}
