<?php

namespace App\Listeners;

use App\Events\LikeTalent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\LikeTalent as LikeTalentNotification;

class UpdateTalentLikeCache
{
    /**
     * Handle the event.
     *
     * @param  LikeTalent  $event
     * @return void
     */
    public function handle(LikeTalent $event)
    {
        $event->post->setActionTypeName($event->type);

        if ($event->type == $event->post::TALENT_LIKE) {
            $event->post->like_cache ++;

            $event->post->user->notify(new LikeTalentNotification($event->post, $event->user));
        } else if ($event->type == $event->post::TALENT_UNLIKE){
            $event->post->like_cache --;
        }

        $event->post->save();
    }
}
