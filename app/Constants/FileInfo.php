<?php

namespace App\Constants;

class FileInfo
{

    /*
    |--------------------------------------------------------------------------
    | File Information
    |--------------------------------------------------------------------------
    |
    | This trait basically contain the path of files and size of images.
    | All information are stored as an array. Developer will be able to access
    | this info as method and property using FileManager class.
    |
    */

    public function fileInfo()
    {
        $data['logo'] = [
            'path' => 'assets/images/setting',
            'size' => '178x50',
        ];
        
        $data['fav_icon'] = [
            'path' => 'assets/images/setting',
            'size' => '50x50',
        ];
        
        $data['userphoto'] = [
            'path' => 'assets/images/userphoto',
            'size' => '100x100',
        ];

        $data['meta_image'] = [
            'path' => 'assets/images/meta_image',
            'size' => '100x100',
        ];
    
        return $data;
    }
}