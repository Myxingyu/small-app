<?php

namespace App\Http\Controllers\v1;



use App\Http\Controllers\Controller;
use App\Product as ProductModel;
use App\validate\IDMustBePositiveInt;
use App\validate\PagingParameter;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getByCategory(Request $request)
    {
        (new IDMustBePositiveInt())->goCheck();
        (new PagingParameter())->goCheck();
        $id = $request->input('id');
        $size = $request->input('size');
        $pagingProducts = ProductModel::getProductsByCategoryID($id, $size);
        $pagingProducts = $pagingProducts->toArray();
        return [
            'data' => $pagingProducts['data'],
            'current_page' => $pagingProducts['current_page']
        ];
    }
}