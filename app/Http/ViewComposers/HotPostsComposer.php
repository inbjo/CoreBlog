<?php

namespace App\Http\ViewComposers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HotPostsComposer
{
    public function compose(View $view)
    {
        $hot_posts = Cache::remember('hot:posts', 3600, function () {
            return Post::getTopBy('view_count', 3);
        });
        $view->with('hot_posts', $hot_posts);
    }
}
