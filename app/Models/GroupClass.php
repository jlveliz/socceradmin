<?php

namespace HappyFeet\Models;

use  Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Auth;

class GroupClass extends Model
{
    
	use SoftDeletes;
    
    protected $table = 'group_class';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    const ACTIVE = 1;

    const INACTIVE = 0;

    protected $fillable = [
        'name',
        'day',
        'schedule_field_parent',
    	'field_id',
    	'coach_id',
		'range_age_id',
        'maximum_capacity',
        'disponibility',
    	'state',
		'created_user_id',
		'schedule'
    ];

    public function students()
    {
    	return $this->belongsToMany('HappyFeet\Models\Student','group_class_student','group_id','student_id');
	}
	
	public function field() {
		return $this->belongsTo('HappyFeet\Models\Field','field_id');
	}

	public static function boot() {
        parent::boot();
        static::creating(function($group){
            $group->created_user_id = Auth::user()->id;
        });
    }

	public function setScheduleAttribute($data) {
        $this->attributes['schedule'] = serialize($data);
    }
    
    public function getScheduleAttribute($data) {
        return  unserialize( $this->attributes['schedule'] );
    }
}
