<?php

namespace HappyFeet\Models;

use  Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Auth;

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
    	'created_user_id'
    ];


    public function groups()
    {
    	return $this->hasMany('HappyFeet\Models\GroupClass','field_id');
    }

    public static function boot() {
        parent::boot();
        static::creating(function($field){
            $field->created_user_id = Auth::user()->id;
        });
    }
}
