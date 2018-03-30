<?php

namespace App;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
class Attraction extends Model
{
    use  Loggable, CanBeLiked;
    const ATTRACTION_UPDATE = 'attraction.update';
    const ATTRACTION_DELETE = 'attraction.delete';
    const ATTRACTION_LIKE = 'attraction.like';
    const ATTRACTION_UNLIKE = 'attraction.unlike';
    const ATTRACTION_FAVORITE = 'attraction.favorite';
    const ATTRACTION_UNFAVORITE = 'attraction.unfavorite';
   const ATTRACTION_CREATE = 'attraction.create';
   //
//    protected $table = 'attraction';
   // protected $dates = ['deleted_at'];
   protected $fillable = ['title','date','content','content_short','view_count','imgUrl','comment_cache','like_cache','favorite_cache','user_id','category_name','category_id'];
   // 操作日志
   public static function boot()
   {
       parent::boot();

       static::creating(function($attraction){
           $attraction->user_id = auth()->id();
           static::setActionTypeName(self::ATTRACTION_CREATE);
       });

       static::updating(function($attraction){
           $types = [
               self::ATTRACTION_LIKE,
               self::ATTRACTION_UNLIKE,
               self::ATTRACTION_FAVORITE,
               self::ATTRACTION_UNFAVORITE
           ];
           if (!in_array(self::$typeName, $types)) {
               static::setActionTypeName(self::ATTRACTION_UPDATE);
           }
       });

       static::deleting(function($attraction){
           static::setActionTypeName(self::ATTRACTION_DELETE);
       });

       static::saving(function($attraction){
           if(auth()->check()) {
               if ($attraction->isDirty('content')) {
                   $attraction->content = $attraction->content;
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
    /**
     * 关联tags表模型。多对多
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag','attraction_tag','attraction_id','tag_id')->withTimestamps();
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
