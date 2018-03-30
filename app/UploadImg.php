<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Loggable;
class UploadImg extends Model
{
    use Loggable;
    const UPLOAD_CREATE = 'upload_img.create';
    const UPLOAD_DELETE = 'upload_img.delete';
    //
    protected $table = 'upload_img';
    protected $fillable = ['name','url','author'];
    public static function boot()
    {
        parent::boot();
        static::creating(function($post){
            static::setActionTypeName(self::UPLOAD_CREATE);
        });
        static::deleting(function($post){
            static::setActionTypeName(self::UPLOAD_DELETE);
        });
    }

}
