<?php

namespace HappyFeet\Providers;

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
        'HappyFeet\Events\Event' => [
            'HappyFeet\Listeners\EventListener',
        ],

        'HappyFeet\Events\UserLoginEvent' => [
            'HappyFeet\Listeners\UpdateLastAccess'
        ],

        'HappyFeet\Events\DeleteEnrollmentGroup' => [
            'HappyFeet\Listeners\DeleteAssistances'
        ],

        'HappyFeet\Events\NewDemoClass' => [
            'HappyFeet\Listeners\SendToActiveCampaign'
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
