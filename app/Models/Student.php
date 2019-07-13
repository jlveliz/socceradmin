<?php

namespace Futbol\Models;

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

    const ACTIVE = 1;

    const INACTIVE = 0;

    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'person_id',
    	'representant_id',
    	'medical_history',
    	'observation',
        'state'
    ];


    public function person()
    {
        return $this->belongsTo('Futbol\Models\Person','person_id');
    }

    public function representant()
    {
    	return $this->belongsTo('Futbol\Models\Person','representant_id');
    }

    public function enrollments() {
        return $this->hasMany('Futbol\Models\Enrollment','student_id');
    }
        
    public function currentEnrollment() {
       return $this->enrollments()->where('state',self::ACTIVE)->first();
    }

    public static function boot() {
        parent::boot();
        static::creating(function($student){
            $student->created_user_id = Auth::user() ? Auth::user()->id : null;
        });

        static::deleting(function($student){
            $student->enrollments()->delete();
            $student->person()->delete();
        });
    }

  
}