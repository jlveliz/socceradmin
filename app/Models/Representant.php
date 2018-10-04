<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class Representant extends Model
{

    use SoftDeletes;

    protected $table = "representant";

    protected $primaryKey = "id";

    // protected $with = ['user'];

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
    	'*'
    ];


    public function user()
    {
    	return $this->belongsTo('HappyFeet\Models\User','user_id');
    }


    public function students()
    {
        return $this->hasMany('HappyFeet\Models\Student','representant_id');
    }

    
    
}
