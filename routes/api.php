<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::get('v1/banner', 'v1\BannerController@getBanner');
Route::get('v1/theme', 'v1\ThemeController@getSimpleList');
Route::get('v1/themeOne', 'v1\ThemeController@getComplexOne');
