<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{
    
    use SoftDeletes;

    protected $table = "season";

    protected $primaryKey = "id";

    protected $dates = [
        'deleted_at'
    ];

    const ACTIVE = 1;

    const INACTIVE = 0;

    protected $fillable = [
    	'name',
    	'duration_num_time',
        'duration_string_time',
        'inscription_price',
        'month_price',
        'state'
    ];

    public function enrollments()
    {
    	// return $this->hasMany('HappyFeet\Models\Permission','module_id');
    }

    public function getActive()
    {
        return self::ACTIVE;
    }

    public function getInActive()
    {
        return self::INACTIVE;
    }

    public function getFormatDuration() {
        $string = "";
        $duration = "";
        if(array_key_exists($this->duration_string_time,get_durations_string())) {
            $duration = get_durations_string()[$this->duration_string_time];
        }
        return $this->duration_num_time . " ".$duration;
    }

}
