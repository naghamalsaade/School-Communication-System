<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassEvent extends Model
{

    protected $table = 'class_event';

    public $timestamps = true;

    protected $fillable = [
        'school_class_id', 'event_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    ##############################Relationships##############################


}
