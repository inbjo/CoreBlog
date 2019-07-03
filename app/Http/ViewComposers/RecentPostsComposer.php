<?php

namespace App\Http\ViewComposers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
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
        $recent_posts = Cache::remember('recent:posts', 3600, function () {
            return Post::getTopBy('id', 5);
        });
        $view->with('recent_posts', $recent_posts);
    }
}
