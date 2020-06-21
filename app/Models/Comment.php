<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id', 'user_id', 'content', 'agent', 'ip'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->favorites()->where($attributes)->exists()) {
            $this->favorites()->create($attributes);
            $count = $this->favorites()->count();
            clearCache('post:' . $this->post_id);
            return ['code' => 0, 'msg' => '点赞成功', 'count' => $count];
        } else {
            return ['code' => 1, 'msg' => '您已经点赞过了哦'];
        }
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }

    public function scopeCommented($query, int $post_id)
    {
        return $query->where('post_id', $post_id);
    }
}
