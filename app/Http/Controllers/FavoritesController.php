<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentWereFavorited;
use App\Notifications\PostWereFavorited;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function comment(Comment $comment)
    {
        if ($comment->user_id == auth()->id()) {
            return ['code' => 1, 'msg' => '不能给自己点赞哦'];
        }
        $comment->user->notify(new CommentWereFavorited($comment));
        return $comment->favorite();
    }

    public function post($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id == auth()->id()) {
            return ['code' => 1, 'msg' => '不能给自己点赞哦'];
        }
        $post->user->notify(new PostWereFavorited($post));
        return $post->favorite();
    }
}
