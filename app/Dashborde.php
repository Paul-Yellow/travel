<?php

namespace App;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;

class Dashborde extends Model
{
    use Loggable;
    const DASH_CREATE = 'dash.create';
    const DASH_UPDATE = 'dash.update';
    const DASH_DELETE = 'dash.delete';
    public static function boot()
    {
        parent::boot();

        static::creating(function($post){
            static::setActionTypeName(self::DASH_CREATE);
        });

        static::updating(function($post){

            static::setActionTypeName(self::DASH_UPDATE);
        });

        static::deleting(function($post){
            static::setActionTypeName(self::DASH_DELETE);
        });
    }
    //
    protected $fillable = ['name','url','author'];
}
