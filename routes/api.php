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

Auth::routes(['verify' => true]);

Route::middleware('auth:api')->get('test3',function(){
    // $ngayhethan = \Illuminate\Support\Facades\Auth::user()->giang_vien->api_token;
    $user = \App\User::where('id',16)->first();
    $giangvien = $user->giang_vien;
    $ngayhethan = $giangvien->NgayHetHan;
    // foreach($giangvien as $gv)
    // $ngayhethan = $gv->NgayHetHan;
    return $ngayhethan;
});

Route::get('test4',function(Request $request){
    $ThoiHanGVMoi = \App\ThoiHanGV::select('SoNgay')->where('id',$request->ThoiHanGV_id)->first()->value('SoNgay');
    return $ThoiHanGVMoi;
});

Route::post('gcs','UserController@testgcs');
Route::post('cloudiary','UserController@testCloudiary');
Route::get('test5','BaiGiangController@NguoiDungChuaMuaKhoaHoc');
Route::get('test6/{KhoaHoc}','DanhGiaController@CapNhatDiemDanhGiaKhoaHoc');
Route::get('testReport','CodeKhoaHocController@testReport');
Route::get('test7',function(){
    return view('payment');
});

// ====================================================================================================

// Route::apiResource('/TheLoaiKhoaHoc','TheLoaiKhoaHocController');
// Route::apiResource('/MangKhoaHoc','MangKhoaHocController');
// Route::apiResource('/KhoaHoc','KhoaHocController');

// ============================ USER ===============================
Route::get('/User/KhoaHocCuaToi','UserController@KhoaHocCuaToi');
Route::apiResource('/User','UserController');
Route::post('/User/TroThanhGiangVien','UserController@TroThanhGiangVien');
Route::put('/User/{User}/UserUpdateImage','UserController@UserUpdateImage')->name('user.UpdateImage');
// Route::group(['prefix' => 'User'], function () {
//     Route::get('/{User}/GiangVien/{GiangVien}/KhoaHocDaDay','GiangVienController@KhoaHocDaDay');
//     Route::get('/{User}/GiangVien/{GiangVien}/LichSuBanKhoaHoc','GiangVienController@LichSuBanKhoaHoc');
//     Route::apiResource('/{User}/GiangVien','GiangVienController');  
//     Route::post('{User}/GiangVien/{GiangVien}/GiaHanThoiHan','GiangVienController@GiaHanThoiHanGV');  
// });

// ============================ GIẢNG VIÊN ===============================
Route::get('GiangVien/{GiangVien}/KhoaHocDaDay','GiangVienController@KhoaHocDaDay');
Route::get('GiangVien/{GiangVien}/LichSuBanKhoaHoc','GiangVienController@LichSuBanKhoaHoc');
Route::get('GiangVien/{GiangVien}/KhoaHocChoDuyet','GiangVienController@KhoaHocChoDuyet');
Route::get('GiangVien/Current','GiangVienController@getGiangVien');
Route::apiResource('GiangVien','GiangVienController');

// ============================ NGÂN HÀNG & TÀI KHOẢN NGÂN HÀNG ===============================
Route::apiResource('/NganHang','NganHangController');
Route::get('/TaiKhoanNganHang/Current','TaiKhoanNganHangController@TaiKhoanCuaCurrentUser');
Route::apiResource('/TaiKhoanNganHang','TaiKhoanNganHangController');

// ============================ HÓA ĐƠN & NHẬP CODE ===============================
Route::get('/HoaDon/Admin','HoaDonController@adminIndex');
Route::apiResource('/HoaDon','HoaDonController');
Route::post('/NhapCode','HoaDonController@NhapCode');

// ============================ THANH TOÁN NGÂN LƯỢNG ===============================
Route::group(['prefix' => 'NganLuong'], function () {
    Route::get('/ThanhToan','NganLuongController@ThanhToan');
    Route::get('/KetQuaTraVe/KhoaHoc/{KhoaHoc}/User/{User}','NganLuongController@KetQuaTraVe')->name('return.url');
    Route::get('/ThongBao','NganLuongController@ThongBao')->name('thongbao');
    Route::get('/redirect','NganLuongController@redirectThongBao');
});

// ============================ COMMENT & ĐÁNH GIÁ ===============================
Route::group(['prefix' => 'KhoaHoc'], function () {
    Route::apiResource('/{KhoaHoc}/Comment','CommentController');    
    Route::apiResource('/{KhoaHoc}/DanhGia','DanhGiaController');
});

// ============================ LEVEL USER ===============================
Route::apiResource('/Level','LevelController');
Route::apiResource('/ThoiHanGV','ThoiHanGVController');

// ============================ CODE KÍCH HOẠT KHÓA HỌC ===============================
Route::apiResource('/CodeKhoaHoc','CodeKhoaHocController');
Route::post('/CodeKhoaHoc/Import','CodeKhoaHocController@import')->name('import');

// ============================ HÌNH THỨC THANH TOÁN ===============================
Route::apiResource('/ThanhToan','ThanhToanController');

// ============================ CÂU HỎI THEO BÀI GIẢNG ===============================
Route::group(['prefix' => 'BaiGiang'], function () {
    Route::apiResource('/{BaiGiang}/CauHoi','CauHoiController');    
});

// ============================ LOGIN (LOCAL - GOOGLE - FACEBOOK) ===============================
Route::group(['prefix' => 'Login'], function () {
    Route::get('{provider}', 'LoginController@redirectToProvider')->name('google.login');
    Route::get('{provider}/callback', 'LoginController@handleProviderCallback');
    Route::post('Local','LoginController@login');
});

// ============================ REGISTER ===============================
Route::post('/Register','RegisterController@register');
Route::get('/Logout','LogoutController@logout');

// ============================ MAIL ===============================
Route::group(['prefix' => 'Mail'], function () {
    Route::get('Verify/{User}','MailController@VerifyEmail')->name('mail.verify');
    Route::get('Resend/{User}','MailController@ResendVerifyEmail')->name('resend.verify');
    Route::get('ResetPassword','MailController@ResetPasswordEmail');
    Route::get('ResendCode','MailController@ResendCode')->name('resend.code');
});

// ============================ REPORT (HÓA ĐƠN - CODE KH) ===============================
Route::group(['prefix' => 'Report'], function () {
    Route::get('HoaDon','ReportController@HoaDonReport');
    Route::get('CodeKH','ReportController@CodeKHReport');
});

// ============================ SEARCH (KHÓA HỌC) ===============================
Route::get('Search','KhoaHocController@SearchKhoaHoc');
// ========================================================================================

// ============================ THỂ LOẠI KHÓA HỌC ===============================
Route::apiResource('/TheLoaiKhoaHoc','TheLoaiKhoaHocController');

// ============================ MẢNG KHÓA HỌC ===============================
Route::group(['prefix' => 'TheLoaiKhoaHoc'], function () {
    Route::apiResource('/{TheLoaiKhoaHoc}/MangKhoaHoc','MangKhoaHocController');   
});

// ============================ KHÓA HỌC ===============================
Route::group(['prefix' => 'MangKhoaHoc'], function () {
    Route::get('/{MangKhoaHoc}/KhoaHoc/Admin','KhoaHocController@indexAdmin')->name('indexAdmin');
    Route::apiResource('/{MangKhoaHoc}/KhoaHoc','KhoaHocController');
});

// ============================ BÀI GIẢNG ===============================
Route::group(['prefix' => 'KhoaHoc'], function () {
    Route::apiResource('/{KhoaHoc}/BaiGiang','BaiGiangController');
    Route::post('/{KhoaHoc}/BaiGiang/Import','BaiGiangController@importBaiGiang')->name('ImportBaiGiang');
});

// ============================ ADMIN DUYỆT KHÓA HỌC ===============================
Route::apiResource('Admin/DuyetKhoaHoc','DuyetKhoaHoc');