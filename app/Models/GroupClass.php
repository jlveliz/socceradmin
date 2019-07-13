<?php

namespace Futbol\Models;

use  Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use appyFeet\Models\AgeRange;
use Auth;

class GroupClass extends Model
{
    
	use SoftDeletes;
    
    protected $table = 'group_class';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $with = ['range','coach'];

    const ACTIVE = 1;

    const INACTIVE = 0;

    protected $fillable = [
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
        return $this->belongsToMany('Futbol\Models\Student','group_class_student','group_id','student_id');
    }

    public function coach()
    {
        return $this->belongsTo('Futbol\Models\User','coach_id');
    }

    public function range()
    {
    	return $this->belongsTo('Futbol\Models\AgeRange','range_age_id');
	}
	
	public function field() {
		return $this->belongsTo('Futbol\Models\Field','field_id');
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


    /**
     * Busca un grupo disponible basandose en su cancha, día, hora, disponibilidad
     * rango de edad y hora
     * 
     */
    public function getAvailableGroupByParams($params)
    {
        $fieldId = $params['field_id'];
        $day = $params['day'];
        $hour = $params['hour'];
        $age = $params['age'];

        $queryLike = '%"start";s:5:"'.$hour.'"%';

        $group = $this->select('id')
                ->whereRaw(" field_id = ".$fieldId." and day = '".$day."' and state = ".self::ACTIVE." and disponibility > 0 and schedule like '".$queryLike."' and range_age_id IN ( SELECT age_range.id FROM age_range WHERE ".$age."  >= age_range.min_age  AND ".$age." <= age_range.max_age AND deleted_at IS NULL ) ")
                ->orderBy('id')
                ->take(1)
                ->first();
        if (!$group) {
            return false;
        }
        return $group->id;
    }
}
