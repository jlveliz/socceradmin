<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';

    protected $primaryKey = 'id';

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
}
