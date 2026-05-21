<?php

namespace App\Observers;

use App\Models\POST;
use Illuminate\Support\Str;
class PostObserver
{
    public function creating(POST $post)
    {
        $slug = Str::slug($post->title);
        $count = POST::where('slug', 'LIKE', "{$slug}%")->count();
        $post->slug = $count ? "{$slug}-{$count}" : $slug;
    }
    /**
     * Handle the POST "created" event.
     */
    public function created(POST $pOST): void
    {
        //
    }

    public function updating(POST $post)
    {
        if ($post->isDirty('title')) {
            $slug = Str::slug($post->title);
            $count = POST::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $post->id)->count();
            $post->slug = $count ? "{$slug}-{$count}" : $slug;
        }
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
