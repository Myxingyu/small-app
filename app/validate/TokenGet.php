<?php

namespace App\validate;


use App\Exceptions\ParameterException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class TokenGet extends Validator
{
    public function goCheck()
    {
        $request = Request::instance();
        $validator = Validator::make($request->all(), [
            'code' => ['required'],
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