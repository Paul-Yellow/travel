<?php

namespace App;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
class NewEvents extends Model
{
    use  Loggable, CanBeLiked;
     const NEWEVENT_UPDATE = 'newevent.update';
     const NEWEVENT_DELETE = 'newevent.delete';
     const NEWEVENT_LIKE = 'newevent.like';
     const NEWEVENT_UNLIKE = 'newevent.unlike';
     const NEWEVENT_FAVORITE = 'newevent.favorite';
     const NEWEVENT_UNFAVORITE = 'newevent.unfavorite';
    const NEWEVENT_CREATE = 'newevent.create';
    //
    protected $table = 'newevent';
    // protected $dates = ['deleted_at'];
    protected $fillable = ['title','date','area','content','content_short','view_count','ln','lo','imgUrl','comment_cache','like_cache','favorite_cache','user_id','category_name','category_id'];
    // 操作日志
    public static function boot()
    {
        parent::boot();

        static::creating(function($newevent){
            $newevent->user_id = auth()->id();
            static::setActionTypeName(self::NEWEVENT_CREATE);
        });

        static::updating(function($newevent){
            $types = [
                self::NEWEVENT_LIKE,
                self::NEWEVENT_UNLIKE,
                self::NEWEVENT_FAVORITE,
                self::NEWEVENT_UNFAVORITE
            ];
            if (!in_array(self::$typeName, $types)) {
                static::setActionTypeName(self::NEWEVENT_UPDATE);
            }
        });

        static::deleting(function($newevent){
            static::setActionTypeName(self::NEWEVENT_DELETE);
        });

        static::saving(function($newevent){
            if(auth()->check()) {
                if ($newevent->isDirty('content')) {
                    $newevent->content = $newevent->content;
                }
            }
        });
    }
    /**
     * Get the user for the blog article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   /**
     * 关联tags表模型。多对多
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function tags()
     {
         return $this->belongsToMany('App\Tag','newevent_tag','newevent_id','tag_id')->withTimestamps();
     }
 
     /**
      * 关联到文章分类模型，一对多。
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function articleCategories()
     {
         return $this->belongsTo('App\Category', 'category_name');
     }

    /**
     * Get the comments for the discussion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
    public function scopeHot($query)
    {
        return $query->orderBy('view_cache', 'desc');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeRecommends($query)
    {
        return $query->orderBy('vote_cache', 'desc');
    }
}
