<?php

namespace App;
use App\Traits\Loggable;
// use Illuminate\Database\Eloquent\Model;
use Ultraware\Roles\Models\Permission as Model;
class Permission extends Model
{
    //
    use Loggable;
    const PERMISSION_CREATE = 'permission.create';
    const PERMISSION_UPDATE = 'permission.update';
    const PERMISSION_DELETE = 'permission.delete';
    public static function boot()
    {
        parent::boot();

        static::creating(function($post){
            static::setActionTypeName(self::PERMISSION_CREATE);
        });

        static::updating(function($post){

            static::setActionTypeName(self::PERMISSION_UPDATE);
        });

        static::deleting(function($post){
            static::setActionTypeName(self::PERMISSION_DELETE);
        });
    }
}
