<?php

namespace HappyFeet\Models;

use Illuminate\Notifications\Notifiable;
use TCG\Voyager\Models\User as VoyagerUser;

class User extends VoyagerUser
{
    use Notifiable;

    protected $table = "users";

    protected $with  = [
        'person'
    ];

    protected $perPage = 10;

   
    public $additional_attributes  = ['full_name'];
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getFullName()
    {
        return "{$this->email} {$this->name}";
    }


    public function person()
    {
       return $this->belongsTo('HappyFeet\Models\Person','person_id');
        
    }
}
