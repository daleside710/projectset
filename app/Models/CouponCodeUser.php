<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponCodeUser extends Model
{
    protected $table = "coupon_code_user";

    protected $guarded = ['id'];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function couponCode(){
        return $this->belongsTo(CouponCode::class);
    }
}
