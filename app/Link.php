<?php

namespace App;;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
class Link extends Model
{
    use Loggable;
    const LINK_CREATE = 'link.create';
    const LINK_UPDATE = 'link.update';
    const LINK_DELETE = 'link.delete';
    public static function boot()
    {
        parent::boot();

        static::creating(function($post){
            static::setActionTypeName(self::LINK_CREATE);
        });

        static::updating(function($post){

            static::setActionTypeName(self::LINK_UPDATE);
        });

        static::deleting(function($post){
            static::setActionTypeName(self::LINK_DELETE);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'link', 'image', 'status'
    ];

 
}
