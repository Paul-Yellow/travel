<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Loggable;
class Report extends Model
{
    use Loggable;
    protected $fillable = [
        'user_id', 'reportable_id', 'reportable_type', 'reason'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($report) {
            $report->user_id = $report->user_id ?? auth()->id();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reportable()
    {
        return $this->morphTo();
    }
}
