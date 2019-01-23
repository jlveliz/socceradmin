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
        'state',
        'class_type'
    ];

    public function fieldOfGroup() {
        $grFounds = [];
        $sameField = false;
        if(count($this->groups) > 0) {
            foreach($this->groups as $key =>  $gr) {
                if($grf = GroupClass::where('state',GroupClass::ACTIVE)->where('id',$gr)->first()) {
                    $grFounds[] = $grf;
                }else {
                    //update the group
                    unset($this->groups[$key]);
                    $this->save();
                }
            }
            $idField = null;
            for ($i=0; $i < count($grFounds); $i++) {
                
                $idField = $grFounds[$i]->field_id;
                
                if($idField == $grFounds[ ($i+1) == count($grFounds) ? $i : ($i+1) ]->field_id) {
                    $sameField = true;
                } else {
                    $sameField = false;
                }
                
            }

          
            if($sameField){
                return $grFounds[0]->field;
            }
        }
        return [];
    }


    public function existGroupOnEnrollment($groupId) {
        $found = false;
        
        foreach($this->groups as $gr) {
            if($gr == $groupId) $found = true;
        }

        return $found;
    }

    public function setGroupsAttribute($data) {
        $this->attributes['groups'] = serialize($data);
    }
    
    public function getGroupsAttribute($data) {
        return  unserialize( $this->attributes['groups'] );
    }


}
