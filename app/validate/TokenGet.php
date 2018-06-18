<?php

namespace App\validate;


use App\Exceptions\ParameterException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TokenGet extends Validator
{
    public function goCheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => ['number'],
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