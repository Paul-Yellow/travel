<?php

namespace App\Transformers;

use App\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    /**
     * Transform a tag
     *
     * @param  Tag $tag
     *
     * @return array
     */
    public function transform(Tag $tag)
    {
        return [
            'id' => $tag->id,
            'name' => $tag->name,
            'creator'=>$tag->creator,
            'path'  => $tag->path,
            'creator_id' =>$tag->creator_id,
            'created_at' => $tag->created_at->toIso8601String(),
            'updated_at' => $tag->updated_at->toIso8601String(),
        ];
    }
}