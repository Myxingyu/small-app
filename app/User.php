<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model
{
    protected $table = 'user';
    public $timestamps = false;
    protected $fillable = ['openid', 'nickname', 'extend', 'delete_time', 'create_time', 'update_time'];

    public static function getByOpenID($openid)
    {
        return self::where('openid', $openid)->first();
    }
}
