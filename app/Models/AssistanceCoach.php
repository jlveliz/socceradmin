<?php

namespace Futbol\Models;

use Illuminate\Database\Eloquent\Model;

class AssistanceCoach extends Model
{
    
    protected $table = 'assistance_coach';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'coach_id',
    	'date',
    	'profit',
        'state',
        'field_id'
    ];


    public function coach()
    {
    	return $this->belongsTo('Futbol\Models\User','coach_id');
    }
}
