<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactEmail extends Model
{
    public $timestamps = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'email',
        'content',
        'replied'
    ];
}
