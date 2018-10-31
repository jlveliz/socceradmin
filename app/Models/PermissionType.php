<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionType extends Model
{
    protected $table = "permission_type";

    protected $primaryKey = "id";

    protected $fillable = [
    	'name',
    	'code',
        'state'
    ];


    public function permissions()
    {
    	return $this->hasMany('HappyFeet\Models\Permission','type_id');
    }


    public static function boot(){
        parent::boot();

        static::creating(function($permissionType){
            $permissionType->code = str_slug($permissionType->name);
        });
    }
}
