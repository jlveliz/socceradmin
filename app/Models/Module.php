<?php

namespace Futbol\Models;

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
    	return $this->hasMany('Futbol\Models\Permission','module_id');
    }


    public function getPermissionsType($idType)
    {
        return $this->permissions()->where('type_id',$idType)->whereNull('parent_id')->get();
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
