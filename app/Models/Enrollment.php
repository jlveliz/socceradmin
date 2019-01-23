<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    
    use SoftDeletes;

    protected $table = "enrollment";

    protected $primaryKey = "id";

    protected $dates = [
        'deleted_at'
    ];

    const ACTIVE = 1;

    const INACTIVE = 0;

    protected $fillable = [
    	'student_id',
        'season_id',
    	'groups',
        'state'
    ];

    public function getFieldOfGroup() {
        dd($this->groups);
        // foreach($this->groups as $gr) {
        //     dd($gr);
        // }
    }

    public function setGroupsAttribute($data) {
        $this->attributes['groups'] = serialize($data);
    }
    
    public function getGroupsAttribute($data) {
        return  unserialize( $this->attributes['groups'] );
    }


}
