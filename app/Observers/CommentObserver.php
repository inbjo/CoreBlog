<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\HaveNewComments;

class CommentObserver
{
    public function created(Comment $comment)
    {
        //文章评论数更新
        $comment->post->comment_count = $comment->post->comments->count();
        $comment->post->save();

        // 通知文章作者有新的评论
        $comment->post->user->notify(new HaveNewComments($comment));
    }
}
