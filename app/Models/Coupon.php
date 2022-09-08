<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{


    use HasFactory, SoftDeletes;
    protected $table = 'coupons';

    protected $fillable = [
        'name',
        'coupon_code',
        'coupon_discount',
        'from',
        'to',
    ];

    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];

}
