<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicationSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = new ApplicationSetting();
        $setting->business_name = 'Art Gallary';
        $setting->business_address = 'Bogura, Bangladesh';
        $setting->business_number = '00000000000';
        $setting->business_email = 'admin@gmail.com';
        $setting->save();
    }
}
