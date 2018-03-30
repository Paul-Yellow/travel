<?php

namespace App\Listeners;

use App\Events\LikeAttraction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\LikeAttraction as LikeAttractionNotification;

class UpdateAttractionLikeCache
{
    /**
     * Handle the event.
     *
     * @param  LikeAttraction  $event
     * @return void
     */
    public function handle(LikeAttraction $event)
    {
        $event->post->setActionTypeName($event->type);

        if ($event->type == $event->post::TALENT_LIKE) {
            $event->post->like_cache ++;

            $event->post->user->notify(new LikeAttractionNotification($event->post, $event->user));
        } else if ($event->type == $event->post::TALENT_UNLIKE){
            $event->post->like_cache --;
        }

        $event->post->save();
    }
}
