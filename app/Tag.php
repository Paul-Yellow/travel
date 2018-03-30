<?php

namespace App;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
class Tag extends Model
{
  use Loggable;
  const TAG_CREATE = 'tag.create';
  const TAG_UPDATE = 'tag.update';
  const TAG_DELETE = 'tag.delete';
    // creator_id
    protected $fillable = ['name','creator_id','path'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected static function boot()
     {
         parent::boot();
 
         static::creating(function($tag) {
             $tag->creator_id = auth()->id();
             static::setActionTypeName(self::TAG_CREATE);
         });
 
         static::updating(function($post){
             static::setActionTypeName(self::TAG_UPDATE);
         });
 
         static::deleting(function($post){
             static::setActionTypeName(self::TAG_DELETE);
         });
     }
    /**
     * Get all of the articles that are assigned this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorpheByMany
     */
     
    /**
     * 关联到活动表 多对多
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function newevents()
     {
         return $this->belongsToMany('App\NewEvents','newevent_tag','tag_id','newevent_id')->withTimestamps();
     }
    //  关联活动盛事
     public function activeevent()
     {
         return $this->belongsToMany('App\ActiveEvents','activeevent_tag','tag_id','activeevent_id')->withTimestamps();
     }
    //  关联优惠活动
    public function offers()
    {
        return $this->belongsToMany('App\Offers','offers_tag','tag_id','offers_id')->withTimestamps();
    }
    //  关联游玩景点
    public function attraction()
    {
        return $this->belongsToMany('App\Attraction','attraction_tag','tag_id','attraction_id')->withTimestamps();
    } 
    //  用户
    public function creator()
    {
        return $this->belongsTo(User::class);
    }
    // 过滤图片不为空
    public function scopePath($query)
    {
        return $query->where('path','<>','');
    }
    // 过滤图片等于空
    public function scopeNoPath($query)
    {
        return $query->where('path','=',null);
    }
}
