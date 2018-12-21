<?php

namespace HappyFeet\Listeners;

use HappyFeet\Events\UserLoginEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use HappyFeet\Models\User;
use Carbon\Carbon;

class UpdateLastAccess
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
     * @param  UserLoginEvent  $event
     * @return void
     */
    public function handle(UserLoginEvent $event)
    {
        if ($user = User::find($event->idUser)) {
            $user->last_access = new Carbon();
            $user->update();
        }
    }
}
