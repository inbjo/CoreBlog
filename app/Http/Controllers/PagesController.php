<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        //取文章列表
        $posts = Post::published()->orderBy('id', 'desc')->with(['user:id,username,nickname', 'tags'])->withCount('comments')->paginate(12);
        return view('pages.index', compact('posts'));
    }

    public function sitemap()
    {
        $view = cache()->remember('generated.sitemap', null, function () {
            $posts = Post::all();
            // return generated xml (string) , cache whole file
            return view('pages.sitemap', compact('posts'))->render();
        });
        return response($view)->header('Content-Type', 'text/xml');
    }

    public function rss()
    {
        $view = cache()->remember('generated.rss', null, function () {
            $posts = Post::all();
            // return generated xml (string) , cache whole file
            return view('pages.rss', compact('posts'))->render();
        });
        return response($view)->header('Content-Type', 'text/xml');
    }


}
