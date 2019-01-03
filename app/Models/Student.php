<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Student extends Model
{
    
    use SoftDeletes;

    const TYPETRIALCLASS = 'trial';

    const STATEINACTIVETRIALLCLASS = '0';

    protected $table = 'student';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'person_id',
    	'representant_id',
    	'medical_history',
    	'observation'
    ];


    public function person()
    {
        return $this->belongsTo('HappyFeet\Models\Person','person_id');
    }

    public function representant()
    {
    	return $this->belongsTo('HappyFeet\Models\Person','representant_id');
    }

    public function groupsClass()
    {
        return $this->belongsToMany('HappyFeet\Models\GroupClass','group_class_student','student_id','group_id');
    }

    public static function boot() {
        parent::boot();
        static::creating(function($field){
            $field->created_user_id = Auth::user()->id;
        });
    }

    // public function hasTakenTrialClass()
    // {
    //     return $this->groupsClass()->where('group_class_student.type',self::TYPETRIALCLASS)
    //            ->where('group_class_student.date','<',date('Y-m-d'))
    //            ->where('group_class_student.state',self::STATEINACTIVETRIALLCLASS)->first();
        
    // }
}