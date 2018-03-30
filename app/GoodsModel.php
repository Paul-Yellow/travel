<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    protected $fillable = ['name', 'sort_num', 'status'];

    public function setSortNumAttribute($value)
    {
        $this->attributes['sort_num'] = empty($value) ? 1 : $value;
    }
}
