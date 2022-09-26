<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalContent extends Model
{

    protected $table = 'educational_contents';

    public $timestamps = true;

    protected $fillable = [
        'title', 'file', 'semester', 'class_subject_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function getSemesterAttribute($val)
    {
        return $val == 1 ? 'First' : 'Second';
    }

    ##############################Relationships##############################

}
