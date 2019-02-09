<?php 

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;
use HappyFeet\Models\Assistance;


class EnrollmentGroup extends Model
{
    protected $table = "enrollment_groups";

    protected $primaryKey = "id";

    protected $dates = [
        'deleted_at'
    ];


    protected $fillable = [
        'enrollment_id',
        'group_id'
    ];


    public function enrollment() {
        return $this->belongsTo('HappyFeet\Models\Enrollment','enrollment_id');
    }

    public function group() {
        return $this->belongsTo('HappyFeet\Models\GroupClass','group_id');
    }


    public function assistances()
    {
        return $this->hasMany('HappyFeet\Models\Assistance','enrollment_group_id');
    }

    private function saveAndCalculateAssitance()
    {
        
        $clastype = $this->enrollment->class_type; // determina que tipo de clase es
        $isFreeClass =  array_key_exists($clastype, get_type_class()) && get_type_class()[$clastype] == 'Demostrativa' ? true : false;

        if($isFreeClass) return true;

        $startDate = $this->enrollment->season ? $this->enrollment->season->start_date : null;
        $endDate = $this->enrollment->season ? $this->enrollment->season->end_date :  null;

        
        $group = $this->group;
        $day = $group->day;

        $startDate = new \DateTime($startDate);
        $endDate = new \DateTime($endDate);
        $interval = \DateInterval::createFromDateString('1 day');

        $period   = new \DatePeriod($startDate, $interval, $endDate);
        
        $datesAssistence = [];
        foreach ($period as $key => $dt) {
            //verify the day 
            if($dt->format('N') == num_days_of_week()[$day]) {
                $datesAssistence[] = $dt;
            }
        }

        foreach ($datesAssistence as $key => $dtAs) {
            $assistance = new Assistance(['date' => $dtAs]);
            $this->assistances()->save($assistance);
        }
    }


    public static function boot() {
        parent::boot();
        static::created(function($enrollmentGroup){
           $enrollmentGroup->saveAndCalculateAssitance();
        });

        static::deleting(function($student){
            $student->enrollments()->delete();
        });
    }



}
