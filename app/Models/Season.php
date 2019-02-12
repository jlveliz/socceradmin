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
    	'start_date',
        'end_date',
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
        if (!$this->start_date || !$this->end_date) {
            return "-";
        }
        return $this->start_date . " hasta ".$this->end_date;
    }


    public function getSeasonActive()
    {
        return $this->where('state',$this->getActive())->first();
    }

}
