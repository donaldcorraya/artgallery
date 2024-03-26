<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CustomerModel extends Authenticatable
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    use HasFactory;
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}