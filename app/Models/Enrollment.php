<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    
    use SoftDeletes;

    protected $table = "enrollment";

    protected $primaryKey = "id";

    protected $dates = [
        'deleted_at'
    ];

    const ACTIVE = 1;

    const INACTIVE = 0;

    protected $fillable = [
    	'student_id',
    	'group_id',
        'season_id',
        'state',
        'inscription_price',
        'month_price'
    ];

    public function group() {
        return $this->belongsTo('HappyFeet\Models\GroupClass','group_id');
    }

}
