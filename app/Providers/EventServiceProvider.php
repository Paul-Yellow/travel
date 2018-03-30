<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\VoteComment' => [
            'App\Listeners\UpdateCommentVoteCache',
        ],
        'App\Events\UserFollow' => [
            'App\Listeners\UserFollowListener',
        ],
        'App\Events\UserCreditChanged' => [
            'App\Listeners\AddUserCreditListener',
        ],
        'App\Events\LikePost' => [
            'App\Listeners\UpdatePostLikeCache',
        ],
        'App\Events\FavoritePost' => [
            'App\Listeners\UpdatePostFavoriteCache',
        ],
        'App\Events\LikeActiveEvent' => [
            'App\Listeners\UpdateActiveEventLikeCache',
        ],
        'App\Events\FavoriteActiveEvent' => [
            'App\Listeners\UpdateActiveEventFavoriteCache',
        ],
        'App\Events\LikeOffers' => [
            'App\Listeners\UpdateOffersLikeCache',
        ],
        'App\Events\FavoriteOffers' => [
            'App\Listeners\UpdateOffersFavoriteCache',
        ],
        'App\Events\LikeTalent' => [
            'App\Listeners\UpdateTalentLikeCache',
        ],
        'App\Events\FavoriteTalent' => [
            'App\Listeners\UpdateTalentFavoriteCache',
        ],
        'App\Events\LikeAttraction' => [
            'App\Listeners\UpdateAttractionLikeCache',
        ],
        'App\Events\FavoriteAttraction' => [
            'App\Listeners\UpdateAttractionFavoriteCache',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
