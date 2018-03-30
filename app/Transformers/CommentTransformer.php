<?php

namespace App\Transformers;
use App\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{

    /**
     * Transform a post.
     *
     * @param  Comment $comment
     *
     * @return array
     */
    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'user_id' => $comment->user_id,
            'type' => class_basename($comment->commentable_type),
            'content' => $comment->content,
            'vote_count'  => $comment->vote_cache,
            'user'      => $comment->user,
            // 踩
            'is_down_voting' => auth()->check() ? auth()->user()->hasDownVoted($comment) : false,
            // 顶
            'is_voting'  => auth()->check() ? auth()->user()->hasUpVoted($comment) : false,
            'date_time'  => $comment->created_at->diffForHumans(),
            'created_at' => $comment->created_at->toIso8601String(),
            'updated_at' => $comment->updated_at->toIso8601String(),
        ];
    }
}