<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
class Administrator extends Authenticatable 
{
    use HasFactory, HasApiTokens;

    protected $guard = 'administrator-api';

    protected $table = 'administrators';

    public $timestamps = true;

    protected $fillable = [
        'user_name', 'age', 'certification', 'user_id', 'fcm_token'

    ];

    protected $hidden = [
       'password', 'created_at', 'updated_at'
    ];

    ##############################Relationships##############################
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function classGroup()
    {
        return $this->hasMany('App\Models\ClassGroup', 'administrator_id', 'id');
    }

}
