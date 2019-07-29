<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApisController extends Controller
{
    public function common()
    {
        $categories = Cache::rememberForever('categories', function () {
            return Category::all();
        });
        $hot_posts = Cache::remember('hot:posts', 3600, function () {
            return Post::getTopBy('view_count', 3);
        });
        $tags = Cache::remember('top:tags', 3600, function () {
            return Tag::getTopHotTags(20);
        });
        $friend_links = Cache::rememberForever('links', function () {
            return Link::all();
        });
        $recent_posts = Cache::remember('recent:posts', 3600, function () {
            return Post::getTopBy('id', 5);
        });
        $site_info = [
            'site_name' => env('SITE_NAME'),
            'site_url' => config('app.url'),
            'site_icp' => env('SITE_ICP'),
            'site_gov' => env('SITE_POLICE'),
        ];
        return compact('categories', 'hot_posts', 'tags', 'friend_links', 'recent_posts', 'site_info');
    }
}
