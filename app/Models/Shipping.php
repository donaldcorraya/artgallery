<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = [
        's_address_one',
        'customer_id',
        's_address_two',
        's_city',
        's_state',
        's_zip',
        's_country',
    ];
    
}
