<?php

namespace App\Listeners;

use App\Events\LikeActiveEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\LikeActiveEvent as LikeActiveEventNotification;

class UpdateActiveEventLikeCache
{
    /**
     * Handle the event.
     *
     * @param  LikeActiveEvent  $event
     * @return void
     */
    public function handle(LikeActiveEvent $event)
    {
        $event->post->setActionTypeName($event->type);

        if ($event->type == $event->post::ACTIVE_LIKE) {
            $event->post->like_cache ++;

            $event->post->user->notify(new LikeActiveEventNotification($event->post, $event->user));
        } else if ($event->type == $event->post::ACTIVE_UNLIKE){
            $event->post->like_cache --;
        }

        $event->post->save();
    }
}
