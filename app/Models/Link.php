<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'name', 'url', 'sort',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
