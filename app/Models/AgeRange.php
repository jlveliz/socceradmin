<?php

namespace Futbol\Models;

use  Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Auth;

class AgeRange extends Model
{
    
	use SoftDeletes;

    protected $table = 'age_range';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'name',
    	'min_age',
    	'max_age',
    ];
}
