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

    public function comment(Comment $comment)
    {
        $comment->user->notify(new YouWereFavorited($comment));
        return $comment->favorite();
    }
}
