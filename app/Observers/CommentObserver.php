<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\PostHaveNewComment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        // 通知文章作者有新的评论
        $comment->post->user->notify(new PostHaveNewComment($comment));
        clearCache();
    }

    public function deleted(Comment $comment)
    {
        clearCache();
    }
}
