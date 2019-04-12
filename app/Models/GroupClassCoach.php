<?php

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;

class GroupClassCoach extends Model
{
    
    
    protected $table = 'group_class_id';

    protected $primaryKey = 'id';

    protected $fillable = [
        'group_class_id',
        'coach_id'
    ];

    public function group()
    {
        return $this->belongsTo('HappyFeet\Models\GroupClass','group_class_id');
    }
}
