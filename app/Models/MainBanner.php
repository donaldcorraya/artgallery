<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainBanner extends Model
{
    use HasFactory;
    protected $fillable = [
        'main_banner_title',
        'main_banner_tagline',
        'main_banner_img',
    ];
}
