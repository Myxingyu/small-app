<?php

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\validate\TokenGet;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function getToken(Request $request)
    {
        (new TokenGet())->goCheck($request);


    }
}