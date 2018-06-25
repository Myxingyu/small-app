<?php

namespace App\Http\service;


use App\enum\ScopeEnum;
use App\Exceptions\ForbiddenException;
use App\Exceptions\ParameterException;
use App\Exceptions\TokenException;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Request;

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

    //基础权限
    public static function needPrimaryScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope >= ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    //用户专有权限
    public static function needExclusiveScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope == ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    //管理员权限
    public static function needSuperScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope == ScopeEnum::Super) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    public static function getCurrentTokenVar($key)
    {
        $request = Request::instance();
        $token = $request->header('token');
        $vars = Redis::get($token);
        if (!$vars) {
            throw new TokenException();
        } else {
            if (!is_array($vars)) {
                $vars = json_decode($vars, true);
            }
            if (array_key_exists($key, $vars)) {
                return $vars[$key];
            } else {
                throw new \Exception('尝试获取的Token变量并不存在');
            }
        }
    }

    public static function getCurrentUid()
    {
        $request = Request::instance();
        $userID = $request->input('uid');
        $uid = self::getCurrentTokenVar('uid');
        $scope = self::getCurrentTokenVar('scope');
        if ($scope == ScopeEnum::Super) {
            if (!$userID) {
                throw new ParameterException([
                    'msg' => '没有指定需要操作的用户对象',
                ]);
            } else {
                return $userID;
            }
        } else {
            return $uid;
        }
    }

}