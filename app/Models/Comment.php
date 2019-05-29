<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
 *
 * @property int $id
 * @property int $post_id 文章ID
 * @property int $parent_id 父评论id
 * @property int $user_id 用户ID
 * @property string $content 评论内容
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Post $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUserId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'user_id', 'content', 'agent', 'ip'
    ];

    //Comment-Post:Many-One
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
            $this->increment('favorite_count');
            $count = $this->favorites()->count();
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
