<?php

namespace App;
use App\Traits\Loggable;
// use Illuminate\Database\Eloquent\Model;
use Ultraware\Roles\Models\Role as Model;
class Role extends Model
{
    use Loggable;
    //
    const ROLE_CREATE = 'role.create';
    const ROLE_UPDATE = 'role.update';
    const ROLE_DELETE = 'role.delete';
    public static function boot()
    {
        parent::boot();

        static::creating(function($post){
            static::setActionTypeName(self::ROLE_CREATE);
        });

        static::updating(function($post){

            static::setActionTypeName(self::ROLE_UPDATE);
        });

        static::deleting(function($post){
            static::setActionTypeName(self::ROLE_DELETE);
        });
    }
}
