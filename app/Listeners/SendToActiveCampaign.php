<?php

namespace Futbol\Listeners;

use Futbol\Events\NewDemoClass;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToActiveCampaign
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewDemoClass  $event
     * @return void
     */
    public function handle(NewDemoClass $event)
    {
        dd($event);
    }
}
