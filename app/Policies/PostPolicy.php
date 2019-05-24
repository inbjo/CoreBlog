<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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

    public function update(User $currentUser, Post $post)
    {
        return $currentUser->id === $post->user_id;
    }

    public function show(User $currentUser, Post $post)
    {
        //状态为1为已发表对所有人显示
        if ($post->status == 1) {
            return true;
        }
        //草稿状态作者可查看
        if ($currentUser->id === $post->user_id) {
            return true;
        }
        //非作者禁止查看
        return false;
    }
}
