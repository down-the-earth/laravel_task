<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'content', 'image'];
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
}
