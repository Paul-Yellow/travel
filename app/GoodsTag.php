<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsTag extends Model
{
    protected $fillable = ['name'];

    /**
     * 关联到商品表 多对多
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function goods()
    {
        return $this->belongsToMany('App\Goods', 'goods_tag_middle', 'tag_id', 'goods_id')->withTimestamps();
    }
}
