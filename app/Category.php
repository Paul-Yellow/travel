<?php

namespace App;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    use Loggable;
    //
    const CATEGORY_CREATE = 'category.create';
    const CATEGORY_UPDATE = 'category.update';
    const CATEGORY_DELETE = 'category.delete';
    public static function boot()
    {
        parent::boot();

        static::creating(function($post){
            static::setActionTypeName(self::CATEGORY_CREATE);
        });

        static::updating(function($post){

            static::setActionTypeName(self::CATEGORY_UPDATE);
        });

        static::deleting(function($post){
            static::setActionTypeName(self::CATEGORY_DELETE);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description','path','pid'
    ];
    /**
     * Get the articles for the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function newevents()
    {
        return $this->hasMany('App\NewEvents', 'category_name');
    }
    // 
    public function activeevents()
    {
        return $this->hasMany('App\ActiveEvents', 'category_name');
    }
}
