<?php

namespace App;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
class Talent extends Model
{
    use  Loggable, CanBeLiked;
    const TALENT_UPDATE = 'talent.update';
    const TALENT_DELETE = 'talent.delete';
    const TALENT_LIKE = 'talent.like';
    const TALENT_UNLIKE = 'talent.unlike';
    const TALENT_FAVORITE = 'talent.favorite';
    const TALENT_UNFAVORITE = 'talent.unfavorite';
   const TALENT_CREATE = 'talent.create';
   //
   protected $table = 'talent';
   // protected $dates = ['deleted_at'];
   protected $fillable = ['title','date','content','content_short','view_count','imgUrl','comment_cache','like_cache','favorite_cache','user_id'];
   // 操作日志
   public static function boot()
   {
       parent::boot();

       static::creating(function($talent){
           $talent->user_id = auth()->id();
           static::setActionTypeName(self::TALENT_CREATE);
       });

       static::updating(function($talent){
           $types = [
               self::TALENT_LIKE,
               self::TALENT_UNLIKE,
               self::TALENT_FAVORITE,
               self::TALENT_UNFAVORITE
           ];
           if (!in_array(self::$typeName, $types)) {
               static::setActionTypeName(self::TALENT_UPDATE);
           }
       });

       static::deleting(function($talent){
           static::setActionTypeName(self::TALENT_DELETE);
       });

       static::saving(function($talent){
           if(auth()->check()) {
               if ($talent->isDirty('content')) {
                   $talent->content = $talent->content;
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
