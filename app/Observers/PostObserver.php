<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function saving(Post $post)
    {
        $post->description = make_description($post->content);
    }
}
