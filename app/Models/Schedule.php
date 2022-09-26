<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    protected $table = 'schedules';

    public $timestamps = true;

    protected $fillable = [
        'type', 'semester', 'file', 'class_group_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function getSemesterAttribute($val)
    {
        return $val == 1 ? 'First' : 'Second';
    }

    public function getTypeAttribute($val)
    {
        return $val == 0 ? 'Work' : 'Exam';
    }

    ##############################Relationships##############################
    
    public function classGroup()
    {
        return $this->belongsTo('App\Models\ClassGroup', 'class_group_id', 'id');
    }
}
