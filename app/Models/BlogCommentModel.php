<?php

namespace App\Models;

use App\Models\BLogModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCommentModel extends Model
{
    use HasFactory;
    protected $table = 'blog_comments';
    protected $primaryKey = 'id';
    protected $guarded=[];

    public function blog()
    {
        return $this->belongsTo(BLogModel::class, 'blog_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
