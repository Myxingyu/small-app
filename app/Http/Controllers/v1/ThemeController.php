<?php

namespace App\Http\Controllers\v1;


use App\Exceptions\ThemeException;
use App\Http\Controllers\Controller;
use App\Theme as ThemeModel;
use App\Theme;
use App\validate\IDCollection;
use App\validate\IDMustBePositiveInt;
use App\validate\ThemeProduct;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * @url /api/v1/theme?ids=id1,id2,id3...
     * @param Request $request
     * @throws \App\Exceptions\ParameterException
     */
    public function getSimpleList(Request $request)
    {
        $validate = new IDCollection();
        $validate->goCheck();
        $ids = $request->input('ids');
        $ids = explode(',', $ids);
//        dd($ids);
        $result = ThemeModel::with(['topicImg', 'headImg'])->find($ids);
        if ($result->isEmpty()) {
            throw new ThemeException();
        }
        return $result;
    }

    /**
     * @url /api/v1/theme?id=id
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     * @throws ThemeException
     * @throws \App\Exceptions\ParameterException
     */
    public function getComplexOne(Request $request)
    {
        $validate = new IDMustBePositiveInt();
        $validate->goCheck();
        $id = $request->input('id');
        $theme = ThemeModel::getThemeWithProducts($id);
//        dd($theme);
        if (!$theme) {
            throw new ThemeException();
        }
        return $theme;
    }

    public function addThemeProduct(Request $request)
    {
        $validate = new ThemeProduct();
        $validate->goCheck();

    }
}