<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'taxs';
    protected $primaryKey = 'id';
    use HasFactory;
    protected $guarded=[];
}
