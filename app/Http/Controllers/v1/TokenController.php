<?php

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Http\service\UserToken;
use App\validate\TokenGet;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function getToken(Request $request)
    {
        $validate = new TokenGet();
        $validate->goCheck();
        $code = $request->input('code');
        $wx = new UserToken($code);
        $token = $wx->get();
        return $token;
    }
}