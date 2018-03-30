<?php

namespace App;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
class ActiveEvents extends Model
{
    use  Loggable, CanBeLiked;
    const ACTIVE_UPDATE = 'activeevent.update';
    const ACTIVE_DELETE = 'activeevent.delete';
    const ACTIVE_LIKE = 'activeevent.like';
    const ACTIVE_UNLIKE = 'activeevent.unlike';
    const ACTIVE_FAVORITE = 'activeevent.favorite';
    const ACTIVE_UNFAVORITE = 'activeevent.unfavorite';
    const ACTIVE_CREATE = 'activeevent.create';
    //
    protected $table = 'activitie_event';
    protected $fillable = ['title','date','area','content','content_short','view_count','ln','lo','imgUrl','comment_cache','like_cache','favorite_cache','user_id','category_name','sponsor','category_id'];
    public static function boot()
    {
        parent::boot();

        static::creating(function($activeevent){
            $activeevent->user_id = auth()->id();
            static::setActionTypeName(self::ACTIVE_CREATE);
        });

        static::updating(function($activeevent){
            $types = [
                self::ACTIVE_LIKE,
                self::ACTIVE_UNLIKE,
                self::ACTIVE_FAVORITE,
                self::ACTIVE_UNFAVORITE
            ];
            if (!in_array(self::$typeName, $types)) {
                static::setActionTypeName(self::ACTIVE_UPDATE);
            }
        });

        static::deleting(function($activeevent){
            static::setActionTypeName(self::ACTIVE_DELETE);
        });

        static::saving(function($activeevent){
            if(auth()->check()) {
                if ($activeevent->isDirty('content')) {
                    $activeevent->content = $activeevent->content;
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
          return $this->belongsToMany('App\Tag','activeevent_tag','activeevent_id','tag_id')->withTimestamps();
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
