<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ShareViewDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //share common view data
//        View::share('cats', Category::all()); //取所有分类
//        View::share('top_tags', Tag::getTopHotTags(20)); //取20个最热门标签
//        View::share('top_posts', Post::getTopFavoritePosts(3)); //取3篇点赞数最多的文章
//        View::share('links', Link::all()); //取所有友链

        View::composer('layouts._nav', 'App\Http\ViewComposers\CategoriesComposer');
        View::composer('layouts._sidebar', 'App\Http\ViewComposers\TagsComposer');
        View::composer('layouts._sidebar', 'App\Http\ViewComposers\PostsComposer');
        View::composer('layouts._footer', 'App\Http\ViewComposers\TagsComposer');
        View::composer('layouts._footer', 'App\Http\ViewComposers\LinksComposer');
        View::composer('layouts._footer', 'App\Http\ViewComposers\PostsComposer');
    }
}
