<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public $timestamps = false;

    public static function getProductsByCategoryID($categoryID, $size = 30)
    {
        return self::where('category_id', $categoryID)->paginate($size);
    }
}
