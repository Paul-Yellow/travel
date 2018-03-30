<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Offers;
class OffersTransformer extends TransformerAbstract
{
  public function transform(Offers $model)
  {
    // sponsor
      return [
        'id'            => $model->id,
        'name'          => $model->name,
        'explain'       => $model->explain,
        'phone'         => $model->phone,
        'date'          => $model->date,
        'area'          => $model->area,
        'imgUrl'        => $model->imgUrl,
        'lo'            => $model->lo,
        'ln'            => $model->ln,
        'category_id' => $model->category_id,
        'sponsor'       => $model->sponsor,
        'comment_count' => $model->comment_cache,
        'like_count'    => $model->like_cache,
        'view_count'    => $model->view_cache,
        'user_id'       => $model->user_id,
        'content_short' => $model->content_short,
        'content'       => $model->content,
        'category_name'   => $model->category_name,
        'view_count'    => $model->view_count,
        'has_liked'     => auth()->check() ? auth()->user()->hasLiked($model) : false,
        'has_favorited' => auth()->check() ? auth()->user()->hasFavorited($model) : false,
        'date_time'     => $model->updated_at->diffForHumans(),
        'created_at'    => $model->created_at->format('Y-m-d H:i:s'),
        'updated_at'    => $model->updated_at->format('Y-m-d H:i:s')
      ];
  }
}