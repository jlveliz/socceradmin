<?php

namespace HappyFeet\Models;

use  Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    
	use SoftDeletes;

    protected $table = 'field';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'name',
    	'address',
    	'type',
    	'width',
    	'height',
    	'created_user_id'
    ];


    public function groups()
    {
    	return $this->hasMany('HappyFeet\Models\GroupClass','field_id');
    }
}
