<?php

namespace HappyFeet\Models;

use  Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    
    use SoftDeletes;

    const TYPETRIALCLASS = 'trial';

    const STATEACTIVETRIALLCLASS = '1';

    protected $table = 'student';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'person_id',
    	'representant_id',
    	'nickname',
    	'genre',
    	'medical_history',
    	'observation'
    ];

    public function representant()
    {
    	return $this->belongsTo('HappyFeet\Models\Representant','representant_id');
    }


    public function groupsClass()
    {
        return $this->belongsToMany('HappyFeet\Models\GroupClass','group_class_student','student_id','group_id');
    }

    public function hasActiveTrialClass()
    {
        $object = $this->groupsClass()->where('group_class_student.type',self::TYPETRIALCLASS)->where('group_class_student.date','<=',date('Y-m-d'))->where('group_class_student.state',self::STATEACTIVETRIALLCLASS)->toSql();
        dd($object);
    }
}