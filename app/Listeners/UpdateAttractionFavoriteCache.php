<?php

namespace App\Listeners;

use App\Events\FavoriteAttraction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\FavoriteAttraction as FavoriteAttractionNotification;

class UpdateAttractionFavoriteCache
{
    /**
     * Handle the event.
     *
     * @param  FavoritePost  $event
     * @return void
     */
    public function handle(FavoriteAttraction $event)
    {
        $event->post->setActionTypeName($event->type);

        if ($event->type == $event->post::TALENT_FAVORITE) {
            $event->post->favorite_cache ++;

            $event->post->user->notify(new FavoriteAttractionNotification($event->post, $event->user));
        } else if ($event->type == $event->post::TALENT_UNFAVORITE){
            $event->post->favorite_cache --;
        }

        $event->post->save();
    }
}
