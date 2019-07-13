<?php

namespace Futbol\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable

{
    use Notifiable;

    protected $table = "user";

    protected $with = ["person"];


    protected $dates = [
        'created_at',
        'updated_at',
        'last_access',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'username', 'password','permission','email','person_id','last_access','state'
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
        return $this->belongsTo('Futbol\Models\Person','person_id');
    }

    public function roles()
    {
        return $this->belongsToMany('Futbol\Models\Role','user_role','user_id','role_id');
    }

 
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


    public function hasRole($idRole)
    {
        $hasRole  = false;
        foreach ($this->roles as $key => $role) {
            if ($role->id == $idRole) $hasRole =  true;
        }

        return $hasRole;
    }

    public function generateGenericPass() {
        $string = "123";
        return Hash::make($string);
    }

    protected static function boot()
    {
        parent::boot();
        static::deleted(function($user){
            $user->person()->delete();
        });
    }
}
