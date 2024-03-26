<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    protected $fillable = [
        'b_address_one',
        'customer_id',
        'b_address_two',
        'b_city',
        'b_state',
        'b_zip',
        'b_country',
    ];
}
