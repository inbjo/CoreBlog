<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class PagesController extends Controller
{
    public function sitemap()
    {
        $sitemap = App::make('sitemap');
        $sitemap->setCache('coreblog.sitemap', 3600);

        if (!$sitemap->isCached()) {
            //首页
            $sitemap->add(url('/'), Carbon::now()->toIso8601String(), '1.0', 'daily');
            //分类目录
            $categorys = Category::all();
            $categorys->each(function ($category) use ($sitemap) {
                $sitemap->add(route('category.show', $category->slug), Carbon::now()->toIso8601String(), '0.9', 'weekly');
            });
            //标签
            $tags = Tag::all();
            $tags->each(function ($tag) use ($sitemap) {
                $sitemap->add(route('tag.show', $tag->name), Carbon::now()->toIso8601String(), '0.9', 'weekly');
            });
            $sitemap->add(route('tags'), Carbon::now()->toIso8601String(), '0.9', 'weekly');
            //文章
            $posts = Post::orderBy('created_at', 'desc')->get();
            $posts->each(function ($post) use ($sitemap) {
                $sitemap->add(route('post.show', $post->slug), $post->updated_at->toIso8601String(), '0.8', 'monthly');
            });
        }

        return $sitemap->render('xml');

    }

    public function feed()
    {
        $feed = App::make("feed");

        $feed->setCache('coreblog.feed', 3600);
        $feed->ctype = "text/xml";

        if (!$feed->isCached()) {
            $posts = Post::orderBy('created_at', 'desc')->with('user')->take(20)->get();

            $feed->title = config('system.name');
            $feed->description = config('system.description');
            $feed->logo = config('app.url') . '/favicon.ico';
            $feed->link = url('feed');
            $feed->setDateFormat('datetime');
            $feed->pubdate = $posts[0]->created_at;
            $feed->lang = 'zh-cn';
            $feed->setShortening(true);
            $feed->setTextLimit(100);

            $posts->each(function ($post) use ($feed) {
                $feed->add($post->title, $post->user->name, route('post.show', $post->slug),
                    $post->created_at->toIso8601String(), $post->description, $post->content);
            });

        }

        return $feed->render('rss');

    }

    public function manifest()
    {
        return view('pages.manifest');
    }

}
