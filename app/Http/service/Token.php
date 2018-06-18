<?php

namespace App\Http\service;


class Token
{
    //生成令牌
    public static function generateToken()
    {
        $randChar = self::getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME'];
        $tokenSalt = config('secure.token_salt');
        return md5($randChar . $timestamp . $tokenSalt);
    }

    public static function getRandChar($length)
    {
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;
        for ($i = 0; $i<$length; $i++){
            $str .= $strPol[rand(0, $max)];
        }
        return $str;
    }
}