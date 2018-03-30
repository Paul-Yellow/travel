<?php

namespace App\Listeners;

use App\Events\LikeOffers;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\LikeOffers as LikeOffersNotification;

class UpdateOffersLikeCache
{
    /**
     * Handle the event.
     *
     * @param  LikeOffers  $event
     * @return void
     */
    public function handle(LikeOffers $event)
    {
        $event->post->setActionTypeName($event->type);

        if ($event->type == $event->post::OFFERS_LIKE) {
            $event->post->like_cache ++;

            $event->post->user->notify(new LikeOffersNotification($event->post, $event->user));
        } else if ($event->type == $event->post::OFFERS_UNLIKE){
            $event->post->like_cache --;
        }

        $event->post->save();
    }
}
