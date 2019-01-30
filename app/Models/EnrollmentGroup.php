<?php 

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class EnrollmentGroup extends Model
{
    protected $table = "enrollment_groups";

    protected $primaryKey = "id";

    protected $dates = [
        'deleted_at'
    ];


    protected $fillable = [
        'enrollment_id',
        'group_id'
    ];


    public function enrollment() {
        return $this->belongsTo('HappyFeet\Models\Enrollment','enrollment_id');
    }
}
