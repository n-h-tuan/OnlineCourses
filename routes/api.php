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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('/TheLoaiKhoaHoc','TheLoaiKhoaHocController');
// Route::apiResource('/MangKhoaHoc','MangKhoaHocController');
// Route::apiResource('/KhoaHoc','KhoaHocController');
Route::apiResource('/User','UserController');
Route::group(['prefix' => 'User'], function () {
    Route::apiResource('/{User}/GiangVien','GiangVienController');    
});
Route::post('/User/TroThanhGiangVien','UserController@becomeInstructor');
Route::apiResource('/HoaDon','HoaDonController');
Route::apiResource('/DanhGia','DanhGiaController');
Route::apiResource('/Comment','CommentController');
Route::apiResource('/Level','LevelController');
Route::apiResource('/ThoiHanGV','ThoiHanGVController');
Route::apiResource('/BaiGiang','BaiGiangController');
// Route::apiResource('/GiangVien','GiangVienController');
Route::apiResource('/CodeKhoaHoc','CodeKhoaHocController');
Route::apiResource('/ThanhToan','ThanhToanController');
Route::apiResource('/CauHoi','CauHoiController');
Route::post('/Login','LoginController@login');
Route::post('/Register','RegisterController@register');

// ========================================================================================

Route::apiResource('/TheLoaiKhoaHoc','TheLoaiKhoaHocController');
Route::group(['prefix' => 'TheLoaiKhoaHoc'], function () {
    Route::apiResource('/{TheLoaiKhoaHoc}/MangKhoaHoc','MangKhoaHocController');
    Route::group(['prefix' => '/{TheLoaiKhoaHoc}/MangKhoaHoc'], function () {
        Route::apiResource('/{MangKhoaHoc}/KhoaHoc','KhoaHocController');
    });
});
