<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\YouWereFavorited;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        if ($request->type == 'comment') {
            $comment = Comment::find($request->id);
            $comment->user->notify(new YouWereFavorited($comment));
            return $comment->favorite();
        }
        if ($request->type == 'post') {
            $post = Post::find($request->id);
//            $post->favorite();
            return ['code' => 0, 'msg' => '点赞成功'];
        }
    }
}
