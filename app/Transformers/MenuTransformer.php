<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Menu;
class MenuTransformer extends TransformerAbstract
{
  public function transform(Menu $model)
  {
      return [
        'id'            => $model->id,
        'pid'           => $model->pid,
        'name'          => $model->name,
        'icon'          => $model->icon,
        'slug'          => $model->slug,
        'url'           => $model->url,
        'active'        => $model->active,
        'sort'          => $model->sort,
        'desription'    => $model->description,
        'created_at'    => $model->created_at->format('Y-m-d H:i:s'),
        'updated_at'    => $model->updated_at->format('Y-m-d H:i:s')
      ];
  }
}