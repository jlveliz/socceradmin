<?php

namespace Futbol\Models;

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
        return $this->belongsTo('Futbol\Models\GroupClass','group_class_id');
    }
}
