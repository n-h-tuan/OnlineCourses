<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class ThoiHanGVMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currentDT = date('d-m-Y H:i:s');
        $giangvien = Auth::user()->giang_vien;
        foreach($giangvien as $gv)
            $NgayHetHan = $gv->NgayHetHan;  
        if(strtotime($NgayHetHan) > strtotime($currentDT))
        {
            // return response()->json([
            //     'data' => "Thời gian là giảng viên vẫn còn",
            // ],200);
            return $next($request);
        }
        else {
            $user = User::find(Auth::id());
            $user->level_id=3;
            $GiangVien = $user->giang_vien;
            foreach($GiangVien as $gv)
            $gv->TrangThai = 0; //Khi liên kết khóa học với id_giangVien, trang thai = 0 thì khóa học đó ko được hiển thị
            $user->save();
            $gv->save();
            return response()->json([
                'data' => "Bạn đã hết thời hạn là giảng viên",
            ]);
        }
        // return $next($request);
    }
}
