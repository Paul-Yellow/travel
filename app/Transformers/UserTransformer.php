<?php
namespace App\Transformers;
use App\User;
use League\Fractal\TransformerAbstract;
class UserTransformer extends TransformerAbstract
{
    // 通过注册app 服务注入
     public function transform(User $user)
    {
        return [
            'id'        => $user->id,
            'name'      => $user->name,
            'email'     => $user->email,
            'iphone'    => $user->iphone,
            'sex'       => $user->sex,
            'address'   => $user->address,
            'status'    => $user->status,
            'avatar'    => $user->avatar,
            'confirm_email' => $user->confirm_email,
            'is_following' => auth()->check() ? auth()->user()->isFollowing($user->id) : false,
            'is_follow_me' => auth()->check() ? $user->isFollowing(auth()->id()) : false,
            'credit_count' => $user->credit_cache,
            'post_count' => $user->post_cache,
            'comment_count' => $user->comment_cache,
            'follower_count' => $user->follower_cache,
            'unread_count' => $user->unreadNotifications()->count(),
            'created_at' => $user->created_at->toIso8601String(),
            'updated_at' => $user->updated_at->toIso8601String(),
        ];
    }
}