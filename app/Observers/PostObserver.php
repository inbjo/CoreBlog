<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function saving(Post $post)
    {
        $post->content= clean($post->content, 'user_post_content');
        $post->description = make_description($post->content);
    }
}
