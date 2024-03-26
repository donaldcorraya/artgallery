<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCouponModel extends Model
{
    protected $table = 'discount_coupons';
    protected $primaryKey = 'id';
    use HasFactory;
    protected $guarded=[];
}
