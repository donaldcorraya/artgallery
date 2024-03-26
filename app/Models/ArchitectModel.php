<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArchitectModel extends Model
{
    protected $table = 'architects';
    protected $primaryKey = 'id';
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
}
