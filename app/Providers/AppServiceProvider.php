<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Observers\PostObserver;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //compatible low mysql version
        Schema::defaultStringLength(191);

        //observer register
        Post::observe(PostObserver::class);

        //share common view data
        View::share('cats', Category::all()); //取所有分类
        View::share('top_tags', Tag::getTopHotTags(20)); //取20个最热门标签
        View::share('top_posts', Post::getTopFavoritePosts(3)); //取3篇点赞数最多的文章
    }
}
