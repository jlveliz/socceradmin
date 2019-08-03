<?php

namespace Futbol\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class FieldType extends Model
{
    
    protected $table = 'field_type';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'name',
    ];
}
