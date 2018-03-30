<?php

namespace App;
use App\Traits\Loggable;
use Jcc\LaravelVote\Vote;
use Illuminate\Notifications\Notifiable;
use Overtrue\LaravelFollow\Traits\CanLike;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanFavorite;
use Overtrue\LaravelFollow\Traits\CanSubscribe;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ultraware\Roles\Traits\HasRoleAndPermission;
use Ultraware\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
class User extends Authenticatable implements HasRoleAndPermissionContract,JWTSubject
{
    use Loggable, Notifiable, CanSubscribe, CanLike, CanFavorite, CanFollow, CanBeFollowed, Vote, HasRoleAndPermission;
    const USER_CREATE = 'user.create';
    const USER_UPDATE = 'user.update';
    const USER_DELETE = 'user.delete';
    const USER_CREDIT = 'user.credit';
    const USER_FOLLOW = 'user.follow';
    const USER_UNFOLLOW = 'user.unfollow';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','avatar','iphone','address','sex','status',
        'post_cache', 'comment_cache', 'follower_cache',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getJWTIdentifier()
    {
        // return $this->getKey();
        return $this->id;
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // boot
    public static function boot()
    {
        parent::boot();

        static::creating(function($post){
            static::setActionTypeName(self::USER_CREATE);
        });

        static::updating(function($post){
            $types = [
                self::USER_CREDIT,
                self::USER_FOLLOW,
                self::USER_UNFOLLOW
            ];

            if (!in_array(self::$typeName, $types)) {
                static::setActionTypeName(self::USER_UPDATE);
            }
        });

        static::deleting(function($post){
            static::setActionTypeName(self::USER_DELETE);
        });
    }
}
