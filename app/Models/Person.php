<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    protected $table = "person";
    
    public function user()
    {
    	return $this->hasOne('HappyFeet\Models\User','person_id');
    }
}
