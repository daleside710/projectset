<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{

    protected $table='chat';
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

    public function user()
    {
        return $this->belongsTo('\App\Models\ChatQueries','chat_id');
    }
}
