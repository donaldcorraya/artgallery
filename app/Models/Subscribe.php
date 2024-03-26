<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table = 'subscribes';
    protected $primaryKey = 'id';
    use HasFactory;
    protected $guarded=[];
}
