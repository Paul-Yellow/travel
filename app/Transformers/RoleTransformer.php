<?php
namespace App\Transformers;
use App\Role;
use League\Fractal\TransformerAbstract;
class RoleTransformer extends TransformerAbstract
{
    // 通过注册app 服务注入
     public function transform(Role $model)
    {
        return [
            'id' =>  $model->id,
            'name' => $model->name,
            'slug' => $model->slug,
            'description' => $model->description,
            'level' => $model->level,
            /* place your other model properties here */
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}