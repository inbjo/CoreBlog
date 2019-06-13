<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Link;
use App\Models\Post;
use App\Models\Tag;
use App\Observers\CommentObserver;
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
        Comment::observe(CommentObserver::class);
    }
}
