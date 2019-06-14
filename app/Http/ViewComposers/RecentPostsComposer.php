<?php

namespace App\Http\ViewComposers;

use App\Models\Post;
use Illuminate\View\View;

class RecentPostsComposer
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function compose(View $view)
    {
        $view->with('top_posts', $this->post::getTopFavoritePosts(3));
    }
}
