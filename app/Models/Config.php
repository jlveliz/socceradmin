<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;


class Config extends Model
{
    use SoftDeletes;
    
    protected $table = "config";

    protected $primaryKey = "id";

    protected $fillable = [
    	'key',
    	'value'
    ];

    protected $dates = ['deleted_at'];


}
