<?php

namespace App\validate;


use App\Exceptions\ParameterException;
use App\Rules\IsPositiveInteger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IDMustBePositiveInt extends Validator
{
    public function goCheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', new IsPositiveInteger()],
            'name' => 'required'
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