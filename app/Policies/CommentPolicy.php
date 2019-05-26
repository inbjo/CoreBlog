<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function delete(User $currentUser, Comment $comment)
    {
        //博主拥有删除所有评论权限
        if ($currentUser->id == 1) {
            return true;
        }

        return $currentUser->id === $comment->user_id;
    }
}
