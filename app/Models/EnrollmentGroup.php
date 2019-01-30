<?php 

namespace HappyFeet\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentGroup extends Models
{
    protected $table = "enrollment_groups";

    protected $primaryKey = "id";

    protected $fillabe = [
        'enrollment_id'
    ];


    public function enrollment() {
        return $this->belongsTo('HappyFeet\Models\Enrollment','enrollment_id');
    }
}
