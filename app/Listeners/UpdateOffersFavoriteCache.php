<?php

namespace App\Listeners;

use App\Events\FavoriteOffers;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\FavoriteOffers as FavoriteOffersNotification;

class UpdateOffersFavoriteCache
{
    /**
     * Handle the event.
     *
     * @param  FavoritePost  $event
     * @return void
     */
    public function handle(FavoriteOffers $event)
    {
        $event->post->setActionTypeName($event->type);

        if ($event->type == $event->post::OFFERS_FAVORITE) {
            $event->post->favorite_cache ++;

            $event->post->user->notify(new FavoriteOffersNotification($event->post, $event->user));
        } else if ($event->type == $event->post::OFFERS_UNFAVORITE){
            $event->post->favorite_cache --;
        }

        $event->post->save();
    }
}
