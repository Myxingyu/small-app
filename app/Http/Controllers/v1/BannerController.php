<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\validate\IDMustBePositiveInt;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function getBanner(Request $request)
    {
        $validate = new IDMustBePositiveInt();
        $validate->goCheck($request);
    }
}