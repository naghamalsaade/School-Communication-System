<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{

    protected $table = 'justifications';

    public $timestamps = true;

    protected $fillable = [
        'text', 'file', 'attendance_check_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    ##############################Relationships##############################
}
