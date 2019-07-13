<?php

namespace Futbol\Providers;

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
        'Futbol\Events\Event' => [
            'Futbol\Listeners\EventListener',
        ],

        'Futbol\Events\UserLoginEvent' => [
            'Futbol\Listeners\UpdateLastAccess'
        ],

        'Futbol\Events\DeleteEnrollmentGroup' => [
            'Futbol\Listeners\DeleteAssistances'
        ],

        'Futbol\Events\NewDemoClass' => [
            'Futbol\Listeners\SendToActiveCampaign'
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
