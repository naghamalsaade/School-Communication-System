<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{

    protected $table = 'subjects';

    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    ##############################Relationships##############################
    
    public function classSubjects()
    {
        return $this->hasMany('Class_subject');
    }

    public function marks()
    {
        return $this->hasMany('Mark');
    }

    public function schoolClasses()
    {
        return $this->belongsToMany('App\Models\SchoolClass', 'class_event','subject_id', 'school_class_id', 'id', 'id');
    }

}
