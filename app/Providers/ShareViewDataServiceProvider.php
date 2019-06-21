<?php

namespace App\Providers;

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
        View::composer('layouts._nav', 'App\Http\ViewComposers\CategoriesComposer');
        View::composer('posts.create', 'App\Http\ViewComposers\CategoriesComposer');
        View::composer('posts.edit', 'App\Http\ViewComposers\CategoriesComposer');
        View::composer('layouts._sidebar', 'App\Http\ViewComposers\RecentPostsComposer');
        View::composer('layouts._sidebar', 'App\Http\ViewComposers\HotTagsComposer');
        View::composer('layouts._footer', 'App\Http\ViewComposers\HotPostsComposer');
        View::composer('layouts._footer', 'App\Http\ViewComposers\HotTagsComposer');
        View::composer('layouts._footer', 'App\Http\ViewComposers\LinksComposer');
    }
}
