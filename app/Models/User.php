<?php

namespace App\Models;

use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Traits\CanPayFloat;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements Customer
{
    use CanPayFloat;
    use Notifiable;

    public $timestamps = [
        'created_at',
        'updated_at',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image_path',
        'address',
        'zip_code',
        'city',
        'phone',
        'uuid',
        'verification_code',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function getFullAddressAttribute()
    {
        $fullAddress = '';
        if ($this->address != '') {
            $fullAddress .= $this->address . ', ';
        }
        if ($this->zip_code != '') {
            $fullAddress .= $this->zip_code . ', ';
        }
        if ($this->city != '') {
            $fullAddress .= $this->city . ', ';
        }

        return $fullAddress;
    }

    public function routeNotificationForOneSignal()
    {
        return $this->uuid;
    }
}
