<?php

namespace App\Models;

use App\Models\BlogCommentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BLogModel extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $primaryKey = 'id';
    protected $guarded=[];

    public function category()
    {
        return $this->belongsTo(BlogCategoryModel::class, 'category_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(BlogCommentModel::class);
    }
}
