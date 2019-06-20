<?php

namespace App\Observers;

use App\Jobs\SyncOnePostToES;
use App\Models\Post;

class PostObserver
{
    /**
     * Post saving
     * @param Post $post
     */
    public function creating(Post $post)
    {
//        $post->content = clean($post->content, 'user_post_content'); //文章内容xss过滤
        if (empty($post->description)) {
            $post->description = make_description($post->content); //截取文章内容作为描述
        }

        //标签自动加超链接 存在bug
//        $tags = explode(',', $post->keyword);
//        foreach ($tags as $tag) {
//            $replace = '<a href="' . route('tag.show', $tag) . '" target="_blank">' . $tag . '</a>';
//            $post->content = str_replace($tag, $replace, $post->content);
//        }
    }

    /**
     * Post created
     * @param Post $post
     */
    public function created(Post $post)
    {
        //更新分类文章数量统计
        $post->category->post_count = $post->category->posts->count();
        $post->category->save();
    }

    /**
     * Post deleting
     * @param Post $post
     */
    public function deleted(Post $post)
    {
        if (!$post->trashed()) {
            //移除所有标签关联
            $post->tags()->detach();

            //删除评论
            $post->comments()->delete();
        }

        //更新分类文章数量统计
        $post->category->post_count = $post->category->posts->count();
        $post->category->save();
    }
}
