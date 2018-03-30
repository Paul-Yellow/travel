<?php

namespace App\Listeners;

use App\Events\FavoriteActiveEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\FavoriteActiveEvent as FavoriteActiveEventNotification;

class UpdateActiveEventFavoriteCache
{
    /**
     * Handle the event.
     *
     * @param  FavoritePost  $event
     * @return void
     */
    public function handle(FavoriteActiveEvent $event)
    {
        $event->post->setActionTypeName($event->type);

        if ($event->type == $event->post::ACTIVE_FAVORITE) {
            $event->post->favorite_cache ++;

            $event->post->user->notify(new FavoriteActiveEventNotification($event->post, $event->user));
        } else if ($event->type == $event->post::ACTIVE_UNFAVORITE){
            $event->post->favorite_cache --;
        }

        $event->post->save();
    }
}
