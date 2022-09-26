<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
class Admin extends Authenticatable 
{
    use HasFactory, HasApiTokens;

    protected $guard = 'admin-api';

    protected $table = 'admins';

    public $timestamps = true;

    protected $fillable = [
        'email', 'first_name', 'last_name',
    ];

    protected $hidden = [
       'password', 'created_at', 'updated_at'
    ];

    ##############################Relationships##############################

}
