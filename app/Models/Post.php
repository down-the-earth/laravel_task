<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['user_id', 'title','slug' ,'content', 'image'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(CommentModel::class);
    }

    public function getTitleAttribute($value)
    {
        return ucwords($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d M Y, h:i A', strtotime($value));
    }

    // Using Model Events to delete comments when a post is deleted
    // protected static function booted(): void
    // {
    //     static::deleting(function ($post) {
    //         $post->comments()->delete();
    //     });
    // }

    protected static function booted(): void
    {
        // Slug title
        static::creating(function ($post){
            // dd($post->title);
            $post->slug = Str::slug($post->title);
        });

         // Cache invalidation
         static::created(function (Post $post) {
            Cache::forget('posts'); 
        });
        static::created(function (Post $post) {
            Cache::forget('posts');
        });

        static::updated(function (Post $post) {
            Log::info('Post updated: ' . $post->id);
            Cache::forget('posts');
        });

        static::deleted(function (Post $post) {
            Log::info('Post deleted: ' . $post->id);
            Cache::forget('posts');
        });
    }
}
