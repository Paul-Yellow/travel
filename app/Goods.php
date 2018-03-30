<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $fillable = ['name', 'other_name', 'goods_category_id', 'goods_model_id', 'img', 'goods_no', 'shop_price', 'market_price', 'store_num', 'seo_title', 'seo_keywords', 'seo_description', 'intro', 'content_html', 'content_markdown', 'is_hot', 'is_new', 'is_recommend', 'is_discount', 'status', 'sort_num', 'sku'];

    protected $appends = ['goods_category_name'];

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($model) {
            $model->goodsAttributes()->detach();
            $model->goodsSpecs()->detach();
            $model->goodsTags()->detach();
        });
    }


    /**
     * 关联goods_tags表模型。多对多
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function goodsTags()
    {
        return $this->belongsToMany('App\GoodsTag', 'goods_tag_middle', 'goods_id', 'tag_id')->withTimestamps();
    }

    /**
     * 关联到商品分类表
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goodsCategories()
    {
        return $this->belongsTo('App\GoodsCategory', 'goods_category_id');
    }

    /**
     * 关联到商品相册表
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goodsImages()
    {
        return $this->hasMany('App\GoodsImage');
    }

    public function goodsAttributes()
    {
        return $this->belongsToMany('App\GoodsAttribute', 'goods_attribute_middle', 'goods_id', 'attribute_id')
            ->withPivot('attr_value')
            ->withTimestamps();
    }

    public function goodsSpecs()
    {
        return $this->belongsToMany('App\GoodsSpec', 'goods_spec_middle', 'goods_id', 'spec_id')
            ->withPivot('spec_value')
            ->withPivot('is_use')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function setGoodsCategoryIdAttribute($value)
    {
        $num = count($value);
        $id = 0;

        for ($i=$num-1; $i>=0; $i--) {
            if (!empty($value[$i])) {
                $id = $value[$i];
                break;
            }
        }

        $this->attributes['three_level_value'] = implode('-', $value);
        $this->attributes['goods_category_id'] = $id;
    }

    public function setSortNumAttribute($value)
    {
        $this->attributes['sort_num'] = empty($value) ? 1 : $value;
    }
    

    public function getGoodsCategoryNameAttribute()
    {
        // $this->getRelation('articleCategories')->name;
        return $this->goodsCategories->name;
    }
}