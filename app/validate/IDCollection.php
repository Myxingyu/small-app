<?php

namespace App\validate;


use App\Exceptions\ParameterException;
use App\Rules\CheckIDs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IDCollection extends Validator
{
    public function goCheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids' => ['required', new CheckIDs()],
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