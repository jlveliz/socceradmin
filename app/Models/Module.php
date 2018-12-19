<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = "module";

    protected $primaryKey = "id";

    protected $casts = [
        'order' => 'int'
    ];

    const ACTIVE = 1;

    const INACTIVE = 0;

    protected $fillable = [
    	'name',
    	'order',
        'state'
    ];

    public function permissions()
    {
    	return $this->hasMany('HappyFeet\Models\Permission','module_id');
    }

    public function getActive()
    {
        return self::ACTIVE;
    }

    public function getInActive()
    {
        return self::INACTIVE;
    }
}
