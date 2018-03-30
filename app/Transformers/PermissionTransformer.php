<?php
namespace App\Transformers;
use App\Permission;
use League\Fractal\TransformerAbstract;
class PermissionTransformer extends TransformerAbstract
{
    // 通过注册app 服务注入
    public function transform(Permission $model)
    {
        return [
            'id'            => $model->id,
            'name'          => $model->name,
            'slug'          => $model->slug,
            'model'         => $model->model,
            'description'   => $model->description,
            'created_at'    => $model->created_at->format('Y-m-d H:i:s'),
            'updated_at'    => $model->updated_at->format('Y-m-d H:i:s')
        ];
    }
}