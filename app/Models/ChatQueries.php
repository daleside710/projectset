<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatQueries extends Model
{

    protected $table='chat_queries';
    protected $fillable = [
        'receiver_id',
        'sender_id',
        'message',
        'status'
    ];

    public $timestamps = [
        'created_at',
        'updated_at'
    ];
    protected $with=['senderUser'];
    public function senderUser()
    {
        return $this->belongsTo('\App\Models\User','sender_id');
    }
}
