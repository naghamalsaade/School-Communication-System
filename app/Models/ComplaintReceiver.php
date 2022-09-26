<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComplaintReceiver extends Model
{

    use HasFactory;

    protected $table = 'complaint_receivers';

    public $timestamps = true;

    protected $fillable = [
        'complaint_id', 'receiver_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    ##############################Relationships##############################

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
