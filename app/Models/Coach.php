<?php

namespace HappyFeet\Models;

use HappyFeet\Models\User;
use HappyFeet\Scopes\CoachScope;

class Coach extends User

{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CoachScope);
    }
}
