<?php

namespace App\Listeners;

use App\Events\FavoriteTalent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\FavoriteTalent as FavoriteTalentNotification;

class UpdateTalentFavoriteCache
{
    /**
     * Handle the event.
     *
     * @param  FavoritePost  $event
     * @return void
     */
    public function handle(FavoriteTalent $event)
    {
        $event->post->setActionTypeName($event->type);

        if ($event->type == $event->post::TALENT_FAVORITE) {
            $event->post->favorite_cache ++;

            $event->post->user->notify(new FavoriteTalentNotification($event->post, $event->user));
        } else if ($event->type == $event->post::TALENT_UNFAVORITE){
            $event->post->favorite_cache --;
        }

        $event->post->save();
    }
}
