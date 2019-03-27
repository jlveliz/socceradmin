<?php

namespace HappyFeet\Models;

use HappyFeet\Models\User;
use HappyFeet\Scopes\CoachScope;

class Coach extends User {


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
