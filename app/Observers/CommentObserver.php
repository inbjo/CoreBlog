<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function saving(Comment $comment)
    {
        $comment->content = clean($comment->content, 'user_post_content'); //评论内容xss过滤
        //todo @xx 自动加超链接
        //todo 触发通知事件
    }
}
