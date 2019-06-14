<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'type', 'no', 'paid_at', 'payment_method', 'payment_no', 'total_amount', 'post_id', 'user_id'
    ];
}
