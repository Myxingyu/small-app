<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'theme';
    public $timestamps = false;
    protected $hidden = ['delete_time', 'topic_img_id', 'head_img_id'];

    public function topicImg()
    {
        return $this->belongsTo('App\Image', 'topic_img_id', 'id');
    }

    public function headImg()
    {
        return $this->belongsTo('App\Image', 'head_img_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'theme_product', 'product_id', 'theme_id');
    }

    public static function getThemeWithProducts($id)
    {
        $theme = self::with(['products', 'topicImg', 'headImg'])->find($id);
        return $theme;
    }
}
