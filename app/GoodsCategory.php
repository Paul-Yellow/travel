<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;

/**
 * 商品分类表
 * Class GoodsCategory
 * @package App
 */
class GoodsCategory extends Model
{
    protected $fillable = ['name', 'alias_name', 'parent_id', 'sort_num', 'status', 'img', 'seo_title', 'seo_keywords', 'seo_description'];

    public function setSortNumAttribute($value)
    {
        $this->attributes['sort_num'] = empty($value) ? 1 : $value;
    }

    public function setParentIdAttribute($value)
    {
        $childId = Request::input('child_id');
        $this->attributes['parent_id'] = !empty($childId) && $childId > 0 ? $childId : $value;
    }

    /**
     * 关联到商品表模型，多对一
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods()
    {
        return $this->hasMany('App\Goods');
    }
}
