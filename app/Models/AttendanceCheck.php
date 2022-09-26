<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceCheck extends Model
{
    use HasFactory;

    protected $table = 'attendance_checks';

    public $timestamps = true;

    protected $fillable = [
        'date', 'type', 'student_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function getTypeAttribute($val)
    {
        return $val == 0 ? 'Delay' : 'Absenc';
    }

    ##############################Relationships##############################
    
    public function justification()
    {
        return $this->hasOne(Justification::class);
    }

}
