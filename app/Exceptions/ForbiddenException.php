<?php
/**
 * Created by PhpStorm.
 * User: xingyu
 * Date: 2018/6/19
 * Time: 18:15
 */

namespace App\Exceptions;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10001;
}