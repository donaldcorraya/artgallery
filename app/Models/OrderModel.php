<?php

namespace App\Models;

use App\Models\ProductModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    use HasFactory; 
    use SoftDeletes;
    protected $guarded=[];

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class, 'customer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
