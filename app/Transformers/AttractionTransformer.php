<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Attraction;
class AttractionTransformer extends TransformerAbstract
{
  
  public function transform(Attraction $model)
  {
      return [
        'id'            => $model->id,
        'title'         => $model->title,
        'date'          => $model->date,
        'imgUrl'        => $model->imgUrl,
        'category_name'=> $model->category_name,
        'category_id' => $model->category_id,
        'comment_count' => $model->comment_cache,
        'like_count'    => $model->like_cache,
        'view_count'    => $model->view_cache,
        'user_id'       => $model->user_id,
        'content_short' => $model->content_short,
        'content'       => $model->content,
        'view_count'    => $model->view_count,
        'has_liked'     => auth()->check() ? auth()->user()->hasLiked($model) : false,
        'has_favorited' => auth()->check() ? auth()->user()->hasFavorited($model) : false,
        'date_time'     => $model->updated_at->diffForHumans(),
        'created_at'    => $model->created_at->format('Y-m-d H:i:s'),
        'updated_at'    => $model->updated_at->format('Y-m-d H:i:s')
      ];
  }
}