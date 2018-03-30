<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ErrorException;

class Order extends Model
{
    protected $fillable = ['order_no', 'user_id', 'status', 'pay_type', 'pay_code', 'goods_price', 'service_price', 'total_price', 'pay_time', 'remark'];

    protected $appends = ['user_name'];

    public function goodsOrders()
    {
        return $this->hasMany('App\Models\GoodsOrder', 'order_id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getUserNameAttribute()
    {
        try {
            $value = $this->users->name;
        } catch(ErrorException $e) {
            $value = '';
        }

        return $value;
    }
}
