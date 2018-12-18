<?php

namespace HappyFeet\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "users";

    protected $with = ["person",'roles'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'person_id', 'username', 'password','permission','super_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function person()
    {
        return $this->belongsTo('HappyFeet\Models\Person','person_id');
    }

    public function roles()
    {
        return $this->belongsToMany('HappyFeet\Models\Role','user_roles','user_id','role_id');
    }

    // public function permissions()
    // {
    //     return $this->hasMany('HappyFeet\Models\UserPermission','user_id');
    // }


    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }


    public function hasRole($role)
    {
        if ($this->roles()->where('code', $role)->first()) {
            return true;
        }
        return false;
    }

    protected static function boot()
    {
        parent::boot();
        static::deleted(function($user){
            $user->person()->delete();
        });
    }
}
