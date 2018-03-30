<?php

namespace App\Transformers;

use App\Link;
use League\Fractal\TransformerAbstract;

class LinkTransformer extends TransformerAbstract
{
    public function transform(Link $model)
    {
        return [
            'id'            => $model->id,
            'name'          => $model->name,
            'image'         => $model->image,
            'link'          => $model->link,
            'status'        => (bool) $model->status,
            'created_at'    => $model->created_at->format('Y-m-d H:i:s'),
            'updated_at'    => $model->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
