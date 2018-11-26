<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;
use  HappyFeet\Events\CreatingField;
use Auth;

class Field extends Model
{
    protected $table = "field";


    protected $perPage = 15;

    protected $fillable = [
    	'created_user_id',
    ];

    public static function boot() {
    	parent::boot();
    	
    	static::creating(function($field){
    		$field->created_user_id = Auth::id();
    	});
    }
}
