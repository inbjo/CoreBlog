<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'name', 'url', 'sort',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
