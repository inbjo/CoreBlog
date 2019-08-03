<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use ErrorException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;
use Overtrue\Pinyin\Pinyin;
use Parsedown;
use Stichoza\GoogleTranslate\GoogleTranslate;

/**
 * App\Post
 *
 * @property int $id
 * @property string $title 标题
 * @property string $keyword 关键词
 * @property string $description 文章描述
 * @property string $content 文章内容
 * @property int $comment_count 评论次数
 * @property int $view_count 浏览次数
 * @property int $favorite_count 点赞次数
 * @property int $published 文章是否发布
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $category_id 分类ID
 * @property int $user_id 用户ID
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCommentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereFavoriteCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereViewCount($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    use SoftDeletes, Searchable, Sluggable;

    protected $fillable = [
        'title', 'keyword', 'description', 'cover', 'content', 'status', 'category_id', 'user_id'
    ];

    /**
     * 将文章markdown格式转换成html
     *
     * @param string $value
     * @return string
     */
    public function getContentAttribute($value)
    {
        $Parsedown = new Parsedown();
        return $Parsedown->text($value);
    }

    /**
     * 获取该模型的路由的自定义键名。
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'translatetitle'
            ]
        ];
    }

    /**
     * 自动翻译文章标题生成友好slug
     * @return string|null
     */
    public function getTranslatetitleAttribute()
    {
        try {
            $tr = new GoogleTranslate('en');
            $tr->setUrl('http://translate.google.cn/translate_a/single');
            $slug = $tr->translate($this->title);
        } catch (ErrorException $e) {
            $pinyin = new Pinyin();
            $slug = $pinyin->permalink($this->title);
        }
        return $slug;
    }

    public function visits()
    {
        return visits($this);
    }

    /**
     * 只查询已发布的文章.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    /**
     * 文章与用户多对一关系绑定
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 文章与分类多对一关系绑定
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 文章与评论一对多关系绑定
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * 文章与标签一对多关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
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

    /**
     * 获取指定属性的文章
     * @param int $count
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getTopBy($field, $count = 3)
    {
        return self::orderBy($field, 'desc')->take($count)->get();
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $arr = Arr::only($this->toArray(), [
            'id',
            'title',
            'keyword',
            'description',
            'content',
        ]);

        $arr['description'] = strip_tags($this->description);
        $arr['content'] = strip_tags($this->content);

        return $arr;
    }
}
