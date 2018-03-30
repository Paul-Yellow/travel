<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ErrorException;

class GoodsAttribute extends Model
{
    protected $fillable = ['model_id', 'name', 'is_search', 'input_type', 'sort_num', 'select_value'];

    protected $appends = ['model_name'];

    /**
     * 关联到商品模型，一对多。
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goodsModels()
    {
        return $this->belongsTo('App\GoodsModel', 'model_id');
    }

    public function goods()
    {
        return $this->belongsToMany('App\Goods', 'goods_attribute_middle', 'attribute_id', 'goods_id')
            ->withPivot('attr_value')
            ->withTimestamps();
    }

    public function getModelNameAttribute()
    {
        try {
            $value = $this->goodsModels->name;
        } catch (ErrorException $e) {
            $value = '';
        }

        return $value;
    }


    public function setSortNumAttribute($value)
    {
        $this->attributes['sort_num'] = empty($value) ? 1 : $value;
    }
}
