<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'first_name', 'last_name', /*'user_name',*/ 'email'
    ];

    protected $hidden = [
        /*'password',*/ 'created_at', 'updated_at', 'remember_token',
    ];

    ##############################Relationships##############################

    public function administrator()
    {
        return $this -> hasOne('App\Models\Administrator', 'user_id', 'id');
    }

    public function student()
    {
        return $this -> hasOne('App\Models\Student', 'user_id', 'id');
    }

    public function complaintTeceivers()
    {
        return $this->hasMany('Complaint_Receiver');
    }

    public function complaints()
    {
        return $this->hasMany('Complaint');
    }
}
