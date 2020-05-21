<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='messages';
    protected $fillable = [
        'receiver_id',
        'sender_id',
        'message',
        'type',
        'status'
    ];

    public $timestamps = [
        'created_at',
        'updated_at'
    ];

//    public function user()
//    {
//        return $this->belongsTo('\App\Models\User');
//    }
}
