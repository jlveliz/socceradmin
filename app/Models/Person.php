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
        'identification_type_id',
        'num_identification',
    	'name',
    	'last_name',
    	'email',
    	'genre',
    	'date_birth',
        'province_id',
        'city_id',
        'parish_id',
        'age',
        'address',
        'phone',
        'mobile',
        'activity',
        'has_facebook',
        'has_twitter',
        'has_instagram',
    ];

    protected $casts = [
        'date_birth' => 'date',
        'province_id' => 'int',
        'city_id' => 'int',
        'parish_id' => 'int',
        'age' => 'int',
        'has_facebook' => 'int',
        'has_twitter' => 'int',
        'has_instagram' => 'int',

    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    

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
