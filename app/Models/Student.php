<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
class Student extends Authenticatable 
{
    use HasFactory, HasApiTokens;

    protected $guard = 'student-api';

    protected $table = 'students';

    public $timestamps = true;

    protected $fillable = [
        'father_name', 'mother_name', 'phone', 'user_name', 'user_id', 'class_group_id', 'fcm_token'
    ];

    protected $hidden = [
        'password', 'created_at', 'updated_at'
    ];

    ##############################Relationships##############################
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function attendances()
    {
        return $this->hasMany(AttendanceCheck::class);
    }

    public function classGroup()
    {
        return $this->belongsTo('App\Models\ClassGroup', 'class_group_id', 'id');
    }

}
