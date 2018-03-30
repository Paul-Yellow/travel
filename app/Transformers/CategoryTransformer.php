<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Category;
class CategoryTransformer extends TransformerAbstract
{
  public function transform(Category $model)
  {
      return [
        'id'            => $model->id,
        'name'          => $model->name,
        'desc'          => $model->description,
        'path'          => $model->path,
        'pid'           => $model->pid,
        'created_at'    => $model->created_at->format('Y-m-d H:i:s'),
        'updated_at'    => $model->updated_at->format('Y-m-d H:i:s')
      ];
  }
}