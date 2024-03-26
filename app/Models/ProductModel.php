<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    use HasFactory;
    protected $guarded=[];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'id')->withTrashed();

    }

    public function architect()
    {
        return $this->belongsTo(ArchitectModel::class, 'architect_id', 'id')->withTrashed();
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    
}
