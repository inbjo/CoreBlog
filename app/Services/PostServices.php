<?php


namespace App\Services;


use Illuminate\Support\Facades\Cache;

class PostServices
{
    /**
     * 获取文章缓存数据
     * @param $post
     * @return mixed
     */
    public static function get($post)
    {
        $data = Cache::rememberForever('post_' . $post->id, function () use ($post) {
            $comments = $post->comments()->with(['user'])->get();
            $tags = $post->tags()->get();
            $names = $comments->pluck('user.name')->unique();
            return compact('post', 'comments', 'names', 'tags');
        });
        return $data;
    }

    /**
     * 文章浏览次数更新
     * @param $post
     * @return bool|int
     */
    public static function updateViewCount($post)
    {
        $key = 'post_view_' . $post->id;
        if (!Cache::has($key)) {
            Cache::forever($key, $post->view_count);
        }
        return Cache::increment($key);
    }

    public static function update($id)
    {

    }

    public static function delete($id)
    {

    }
}
