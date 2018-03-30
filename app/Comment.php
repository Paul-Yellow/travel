<?php

namespace App;
use App\Traits\Loggable;
use Jcc\LaravelVote\CanBeVoted;
use Illuminate\Database\Eloquent\Model;
class Comment extends Model
{
   use Loggable, CanBeVoted;

    protected $vote = User::class;

    const COMMENT_CREATE = 'comment.create';
    const COMMENT_UPDATE = 'comment.update';
    const COMMENT_DELETE = 'comment.delete';
    const COMMENT_UP_VOTE = 'comment.up_vote';
    const COMMENT_DOWN_VOTE = 'comment.down_vote';
    const COMMENT_CANCEL_UP_VOTE = 'comment.cancel_up_vote';
    const COMMENT_CANCEL_DOWN_VOTE = 'comment.cancel_down_vote';
    const COMMENT_UP_TO_DOWN_VOTE = 'comment.up_to_down_vote';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'commentable_id', 'commentable_type',
       'content',  'vote_cache'
    ];
    
    //  boot
     public static function boot()
    {
        parent::boot();

        static::creating(function($comment){
            $comment->user_id = auth()->id();
            static::setActionTypeName(self::COMMENT_CREATE);
        });

        static::updating(function($post){
            static::setActionTypeName(self::COMMENT_UPDATE);
        });

        static::saving(function ($comment) {
            if(auth()->check() && $comment->isDirty('content')) {
                $comment->content = $comment->content;
            }
        });

        static::deleting(function ($comment) {
            static::setActionTypeName(self::COMMENT_DELETE);
        });
    }
    


    /**
     * Get the user for the discussion comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the owning commentable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
