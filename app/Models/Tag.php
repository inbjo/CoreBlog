<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Tag
 *
 * @property int $id
 * @property string $name 标签名称
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    //Tag-Post:Many-Many
    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    /**
     * 为路由模型获取键名。
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * 获取最热门的标签
     * @param int $count
     * @return Tag[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getTopHotTags($count = 20)
    {
        return self::withCount('posts')->orderBy('posts_count', 'desc')->limit($count)->get();
    }

    public static function getTagIds($tags)
    {
        $tagids = [];
        if (empty(trim($tags))) {
            return $tagids;
        }
        $tagNames = explode(',', $tags);
        foreach ($tagNames as $name) {
            $tag = Tag::firstOrCreate(['name' => trim($name)]);
            $tagids[] = $tag->id;
        }
        return $tagids;
    }
}
