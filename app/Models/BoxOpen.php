<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoxOpen extends Model
{
    public $timestamps = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'user_id',
        'box_id',
        'is_opened',
        'is_notified',
    ];

    public function box()
    {
        return $this->belongsTo(Box::class, 'id');
    }
}
