<?php

namespace App\Http\Controllers\v1;

use App\Banner;
use App\Exceptions\MissException;
use App\Http\Controllers\Controller;
use App\validate\IDMustBePositiveInt;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * @url /api/v1/banner?id=id
     * @param Request $request
     * @return mixed
     * @throws MissException
     * @throws \App\Exceptions\ParameterException
     */
    public function getBanner(Request $request)
    {
        $validate = new IDMustBePositiveInt();
        $validate->goCheck();
        $id = $request->input('id');
        $banner = Banner::getBannerById($id);
        if ($banner->isEmpty()) {
            throw new MissException([
                'msg' => '请求banner不存在',
                'errorCode' => 40000
            ]);
        }
        return $banner;
    }
}