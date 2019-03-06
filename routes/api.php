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

Route::apiResource('/TheLoaiKhoaHoc','TheLoaiKhoaHocController');
Route::apiResource('/MangKhoaHoc','MangKhoaHocController');
Route::apiResource('/KhoaHoc','KhoaHocController');
Route::apiResource('/User','UserController');
Route::apiResource('/HoaDon','HoaDonController');
Route::apiResource('/DanhGia','DanhGiaController');
Route::apiResource('/Comment','CommentController');
Route::apiResource('/Level','LevelController');
Route::apiResource('/ThoiHanGV','ThoiHanGVController');
Route::apiResource('/BaiGiang','BaiGiangController');
Route::apiResource('/GiangVien','GiangVienController');
Route::apiResource('/CodeKhoaHoc','CodeKhoaHocController');
Route::apiResource('/ThanhToan','ThanhToanController');
Route::apiResource('/CauHoi','CauHoiController');
Route::apiResource('/Login','LoginController');
Route::apiResource('/Register','RegisterController');