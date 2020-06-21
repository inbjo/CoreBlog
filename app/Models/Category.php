<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'sort', 'description',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
