<?php

namespace App\validate;


use App\Exceptions\ParameterException;
use App\Rules\IsPositiveInteger;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class IDMustBePositiveInt extends Validator
{
    public function goCheck()
    {
        $request = Request::instance();
        $validator = Validator::make($request->all(), [
            'id' => ['required', new IsPositiveInteger()],
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