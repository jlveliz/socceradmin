<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "role";

    protected $primaryKey = "id";

    protected $fillable = [
    	'name',
        'code',
    	'description',
        'is_default'
    ];

    protected $with = ['permissions'] ;

    public function permissions()
    {
    	return $this->belongsToMany('HappyFeet\Models\Permission','permission_role','role_id','permission_id');
    }

    public function hasPermission($idPermission)
    {
        foreach ($this->permissions as $key => $permission) {
            if ($permission->id == $idPermission) return true;
            return false;
        }
    }

    public function users()
    {
        return $this->belongsToMany('HappyFeet\Models\User','user_role','role_id','user_id');
    }

    public function getIsDefaultAttribute($value)
    {
        return (string)$value;
    }

    protected static function boot() {
        parent::boot();
        static::creating(function($role) { // before inserting update all items to default 1
            if ($role->is_default == 1) {
                $istance = new Static();
                $istance->where('is_default',\DB::raw(1))->update(['is_default'=>0]);
            }
            $role->code = str_slug($role->name);
        }); 

        static::updating(function($role) { // before inserting update all items to default 1
            if ($role->is_default == 1) {
                $istance = new Static();
                $istance->where('is_default',\DB::raw(1))->update(['is_default'=>0]);
            }
        });
    }
}
