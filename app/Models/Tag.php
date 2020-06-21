<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

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
