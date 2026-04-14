<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CommentModel;
use App\Models\Post;

class CommentModelPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, CommentModel $comment)
    {
        return $user->id === $comment->user_id;
    }

    public function update(User $user, CommentModel $comment)
    {
        return $user->id === $comment->user_id;
    }
}
