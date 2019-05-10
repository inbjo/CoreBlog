<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\View;

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function share_data(){
    View::share('cats', Category::all()); //取所有分类
    View::share('top_tags', Tag::getTopHotTags(20)); //取20个最热门标签
    View::share('top_posts', Post::getTopFavoritePosts(3)); //取3篇点赞数最多的文章
}
