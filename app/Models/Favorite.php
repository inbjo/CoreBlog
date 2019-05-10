<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Url
 *
 * @property int $id
 * @property string $type 类型
 * @property string $name 名称
 * @property string|null $value 网址
 * @property string|null $remark 备注
 * @property int $parent 父ID
 * @property int $sort 排序
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite whereValue($value)
 * @mixin \Eloquent
 */
class Favorite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','sort','urls'
    ];

    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'urls' => 'array',
    ];

}
