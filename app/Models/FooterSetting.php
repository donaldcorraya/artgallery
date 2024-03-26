<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $table = 'footer_settings';
    protected $primaryKey = 'id';
    use HasFactory;
    protected $guarded=[];
}
