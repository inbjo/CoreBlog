<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostObserver
{
    public function saving(Post $post)
    {
        $post->content = clean($post->content, 'user_post_content'); //文章内容xss过滤
        $post->description = make_description($post->content); //截取文章内容作为描述
    }

    public function saved(Post $post){
        //标签自动加超链接 存在bug
//        $tags = explode(',', $post->keyword);
//        foreach ($tags as $tag) {
//            $replace = '<a href="' . route('tag.show', $tag) . '" target="_blank">' . $tag . '</a>';
//            $post->content = str_replace($tag, $replace, $post->content);
//        }
    }
}
