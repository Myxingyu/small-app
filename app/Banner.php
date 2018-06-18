<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';
    public $timestamps = false;

    public static function getBannerById($id)
    {
        $banner = self::where('id', $id)->get();
        return $banner;
    }
}
