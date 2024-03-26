<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BottomBanner extends Model
{
    use HasFactory;
    protected $fillable = [
        'bottom_banner_title',
        'bottom_banner_tagline',
        'bottom_banner_img',
    ];
}
