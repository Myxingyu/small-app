<?php
/**
 * Created by PhpStorm.
 * User: xingyu
 * Date: 2018/6/17
 * Time: 13:36
 */

namespace App\validate;


use App\Exceptions\ParameterException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class ThemeProduct extends Validator
{
    public function goCheck()
    {
        $request = Request::instance();
        $validator = Validator::make($request->all(), [
            't_id' => ['number'],
            'p_id' => ['number'],
        ]);
        if ($validator->fails()) {
            $exception = new ParameterException([
                'msg' => $validator->errors(),
            ]);
            throw $exception;
        } else {
            return true;
        }
    }
}