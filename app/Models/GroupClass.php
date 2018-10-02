<?php

namespace HappyFeet\Models;

use  Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class GroupClass extends Model
{
    
	use SoftDeletes;
    
    protected $table = 'group_class';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'range_age_id',
    	'coach_id',
    	'field_id',
    	'start_hour',
    	'end_hour',
    	'maximum_capacity',
    	'state',
    	'created_user_id',
    ];

    public function students()
    {
    	return $this->belongsToMany('HappyFeet\Models\Student','group_class_student','group_id','student_id');
    }
}
