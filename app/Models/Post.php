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

class Post extends Model
{
//    use SoftDeletes, Searchable, Sluggable;

    protected $fillable = [
        'title', 'keyword', 'description', 'cover', 'content', 'status', 'category_id',
        'user_id', 'publish_time', 'password', 'allow_comment'
    ];

    protected $casts = [
        'allow_comment' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $hidden = [
        'password'
    ];

    /**
     * 将文章markdown格式转换成html
     *
     * @param string $value
     * @return string
     */
//    public function getContentAttribute($value)
//    {
//        $Parsedown = new Parsedown();
//        $Parsedown->setSafeMode(true);
//        return $Parsedown->text($value);
//    }

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

//    public function getTranslatetitleAttribute()
//    {
//        try {
//            $tr = new GoogleTranslate('en');
//            $tr->setUrl('http://translate.google.cn/translate_a/single');
//            $slug = $tr->translate($this->title);
//        } catch (ErrorException $e) {
//            $pinyin = new Pinyin();
//            $slug = $pinyin->permalink($this->title);
//        }
//        return $slug;
//    }

    public function visits()
    {
        return visits($this);
    }

    public function scopeGetType($query, $type)
    {
        switch ($type) {
            case 'published':
                return $query->where('status', 1)->whereNull('password')->where('publish_time', '<=', time());
            case 'draft':
                return $query->where('status', 0);
            default:
                return $query;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

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
            $count = $this->favorites()->count();
            clearCache('post:' . $this->id);
            return ['code' => 0, 'msg' => '点赞成功', 'count' => $count];
        } else {
            return ['code' => 1, 'msg' => '您已经点赞过了哦'];
        }
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }

    public static function getTopBy($field, $count = 3)
    {
        return self::orderBy($field, 'desc')->take($count)->get();
    }

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
