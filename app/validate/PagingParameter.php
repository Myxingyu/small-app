<?php

namespace App\validate;


use App\Exceptions\ParameterException;
use App\Rules\IsPositiveInteger;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class PagingParameter
{
    public function goCheck()
    {
        $request = Request::instance();
        $validator = Validator::make($request->all(), [
            'page' => ['required', new IsPositiveInteger()],
            'size' => ['required', new IsPositiveInteger()],
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