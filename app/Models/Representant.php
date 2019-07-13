<?php

namespace Futbol\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class Representant extends Model
{

    use SoftDeletes;

    protected $table = "representant";

    protected $primaryKey = "id";

    protected $with = ['user'];

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
    	'user_id',
        'state'
    ];


    public function user()
    {
    	return $this->belongsTo('Futbol\Models\User','user_id');
    }


    public function students()
    {
        return $this->hasMany('Futbol\Models\Student','representant_id');
    }

    
    
}
