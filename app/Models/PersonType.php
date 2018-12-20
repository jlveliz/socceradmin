<?php
namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class PersonType extends Model
{
	
	protected $table = 'person_type';

    const ACTIVE = 1;

    const INACTIVE = 0;

    protected $fillable = [
        'name',
        'code',
        'state'
    ];


	public static function boot()
    {
        $istance = new Static;
        parent::boot();
        static::creating(function($personType){
            $personType->code =  str_slug($personType->name);
        });
    }
}