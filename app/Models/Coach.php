<?php

namespace Futbol\Models;

use Futbol\Models\User;
use Futbol\Scopes\CoachScope;

class Coach extends User {


	const ROLE = "coach";

	const ALTROLE = "coach";

	public function getCoachsByField($fieldId)
	{
		return $this->whereRaw("user.id in ( SELECT group_class.coach_id FROM group_class WHERE group_class.field_id = $fieldId)")->get();
	}

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CoachScope);
    }
}
