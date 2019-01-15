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

    protected $with = ['groups'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'name',
    	'address',
    	'type',
        'created_user_id',
        'available_days'
    ];


    public function groups()
    {
    	return $this->hasMany('HappyFeet\Models\GroupClass','field_id');
    }


    public function setAvailableDaysAttribute($data) {
        $this->attributes['available_days'] = serialize($data);
    }
    
    public function getAvailableDaysAttribute($data) {
        return  unserialize( $this->attributes['available_days'] );
    }

    public static function boot() {
        parent::boot();
        static::creating(function($field){
            $field->created_user_id = Auth::user()->id;
        });
        static::deleting(function($field){
            $field->groups()->delete();
        });
    }


    public function getFormatScheduleDay ($day) {
        $message = "De ";
        foreach($day as $hour) {
            // dd($hour);
            $message.= $hour['start'] . ' hasta las ';
            $message.= $hour['end'];
        }
        var_dump($message);
        return $message;
    }
}
