<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategoryModel extends Model
{
    protected $table = 'blogcategories';
    protected $primaryKey = 'id';
    use HasFactory;
    protected $guarded=[];
}
