<?php

namespace App;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
class Offers extends Model
{
    use  Loggable, CanBeLiked;
    const OFFERS_UPDATE = 'offers.update';
    const OFFERS_DELETE = 'offers.delete';
    const OFFERS_LIKE = 'offers.like';
    const OFFERS_UNLIKE = 'offers.unlike';
    const OFFERS_FAVORITE = 'offers.favorite';
    const OFFERS_UNFAVORITE = 'offers.unfavorite';
    const OFFERS_CREATE = 'offers.create';
    //
    protected $table = 'offers_activitie';
    protected $fillable = ['name','phone','explain','date','area','content','content_short','view_count','ln','lo','imgUrl','comment_cache','like_cache','favorite_cache','user_id','category_name','category_id'];
    public static function boot()
    {
        parent::boot();

        static::creating(function($offers){
            $offers->user_id = auth()->id();
            static::setActionTypeName(self::OFFERS_CREATE);
        });

        static::updating(function($offers){
            $types = [
                self::OFFERS_LIKE,
                self::OFFERS_UNLIKE,
                self::OFFERS_FAVORITE,
                self::OFFERS_UNFAVORITE
            ];
            if (!in_array(self::$typeName, $types)) {
                static::setActionTypeName(self::OFFERS_UPDATE);
            }
        });

        static::deleting(function($offers){
            static::setActionTypeName(self::OFFERS_DELETE);
        });

        static::saving(function($offers){
            if(auth()->check()) {
                if ($offers->isDirty('content')) {
                    $offers->content = $offers->content;
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
          return $this->belongsToMany('App\Tag','offers_tag','offers_id','tag_id')->withTimestamps();
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
