<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Assistance extends Model
{
    
    protected $table = 'assistance';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'enrollment_group_id',
    	'date',
    	'state',
        'observation'
    ];


    public function enrollmentGroup()
    {
    	return $this->belongsTo('HappyFeet\Models\EnrollmentGroup','enrollment_group_id');
    }
}
