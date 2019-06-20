<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PagesController extends Controller
{
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

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $posts = Post::search($keyword)->orderBy('id', 'desc')->paginate(12);
        return view('posts.search', compact('posts', 'keyword'));
    }

}
