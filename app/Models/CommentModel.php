<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $fillable = ['post_id', 'user_id', 'content'];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getContentAttribute($value)
    {
        return ucfirst($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d M Y, h:i A', strtotime($value));
    }

    protected static function booted(): void
    {
        static::creating(function ($comment){
            // dd($post->title);
            $comment->content = ucfirst($comment->content);
            $comment->user_id = auth()->id();
        });
        static::created(function (CommentModel $comment) {
            Log::info('Comment By: ' . auth()->user()->name . ' - Comment ID: ' . $comment->id);
            Cache::forget('posts');
        });

        static::updated(function (CommentModel $comment) {
            Log::info('Comment updated: ' . $comment->id);
            Cache::forget('posts');
        });

        static::deleted(function (CommentModel $comment) {
            Log::info('Comment deleted: ' . $comment->id);
            Cache::forget('posts');
        });
    }
  
}
