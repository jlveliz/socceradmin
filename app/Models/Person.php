<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    
    use SoftDeletes;

    protected $table = "person";

    protected $primaryKey = "id";

    private $male = "M";

    private $female = "F";

    protected $fillable = [
    	'person_type_id',
        'num_identification',
    	'name',
    	'last_name',
    	'genre',
        'age',
        'address',
        'phone',
        'mobile',
        'activity',
        'facebook_link',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    

    public function personType()
    {
        return $this->belongsTo('HappyFeet\Models\PersonType','person_type_id');
    }

    public function province()
    {
        return $this->belongsTo('HappyFeet\Models\Province','province_id');
    }

    public function city()
    {
        return $this->belongsTo('HappyFeet\Models\City','city_id');
    }

    public function parish()
    {
    	return $this->belongsTo('HappyFeet\Models\Parish','city_id');
    }

    public function identificationType()
    {
        return $this->belongsTo('HappyFeet\Models\IdentificationType','identification_type_id');
    }

    public function getMale()
    {
        return $this->male;
    }

    public function getFemale()
    {
        return $this->female;
    }

    public function setDateBirthAttribute($value)
    {
        $this->attributes['date_birth'] = date('Y-m-d',strtotime($value));
    }

    public function user()
    {
        return $this->hasOne('HappyFeet\Models\User','person_id');
    }

    



   


}
