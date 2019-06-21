<?php

namespace App\Http\ViewComposers;

use App\Models\Post;
use Illuminate\View\View;

class HotPostsComposer
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function compose(View $view)
    {
        $view->with('hot_posts', $this->post::getTopBy('view_count', 3));
    }
}
