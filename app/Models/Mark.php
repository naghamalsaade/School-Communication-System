<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{

    protected $table = 'marks';

    public $timestamps = true;

    protected $fillable = [
        'type', 'semester', 'value' ,'subject_id', 'student_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function getSemesterAttribute($val)
    {
        return $val == 1 ? 'First' : 'Second';
    }

    ##############################Relationships##############################

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id', 'id');
    }

}
