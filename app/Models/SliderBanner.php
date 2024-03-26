<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderBanner extends Model
{
    use HasFactory;
    protected $fillable = [
        'slider_banner_title',
        'slider_banner_tagline',
        'slider_banner_img',
    ];
}
