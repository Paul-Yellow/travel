<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ErrorException;

class GoodsSpec extends Model
{
    protected $fillable = ['name', 'model_id', 'select_value', 'sort_num'];

    protected $appends = ['model_name'];

    /**
     * 关联到商品模型，一对多。
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goodsModels()
    {
        return $this->belongsTo('App\GoodsModel', 'model_id');
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

    public function goods()
    {
        return $this->belongsToMany('App\Goods', 'goods_spec_middle', 'spec_id', 'goods_id')
            ->withPivot('spec_value')
            ->withPivot('is_use')
            ->withPivot('price')
            ->withTimestamps();
    }


    public function setSortNumAttribute($value)
    {
        $this->attributes['sort_num'] = empty($value) ? 1 : $value;
    }
}
