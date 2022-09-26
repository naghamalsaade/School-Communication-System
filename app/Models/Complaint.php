<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaints';

    public $timestamps = true;

    protected $fillable = [
        'title', 'text', 'date', 'sender_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    // protected $casts = [
    //     'text' => 'encrypted'
    // ];

    ##############################Relationships##############################

    public function receiver()
    {
        return $this -> hasOne(ComplaintReceiver::class);
    }
}
