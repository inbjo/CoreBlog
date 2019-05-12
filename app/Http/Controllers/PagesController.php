<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        //取文章列表
        $posts = Post::with(['user:id,name', 'tags'])->withCount('comments')->paginate(12);
        return view('pages.index',compact('posts'));
//        return view('pages.test');
    }
}
