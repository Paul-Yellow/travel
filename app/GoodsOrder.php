<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsOrder extends Model
{
    protected $fillable = ['order_id', 'from_order_no', 'goods_id', 'user_id', 'fund_number', 'goods_name', 'goods_sku', 'goods_no', 'goods_num', 'market_price', 'shop_price', 'spec_key', 'spec_name', 'start_time', 'end_time', 'city'];
}
